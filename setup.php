<?php
declare(strict_types=1);
require __DIR__ . '/app/bootstrap.php';
try {
    $token = (string)(config()['setup_token'] ?? '');
    if (strlen($token) < 32 || (int)db()->query('SELECT COUNT(*) FROM jp_users')->fetchColumn() > 0) {
        http_response_code(404);
        exit('Página indisponível.');
    }
} catch (Throwable $e) {
    http_response_code(503);
    exit('Configure o banco de dados e importe schema.sql antes de criar a primeira conta.');
}
$isSetup = true;
$title = 'Configure seu acesso';
$description = 'Crie a primeira conta para administrar seu estoque.';
$error = '';
$email = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = strtolower(trim((string)($_POST['email'] ?? '')));
    $password = (string)($_POST['password'] ?? '');
    if (!valid_csrf($_POST['csrf'] ?? null)) {
        http_response_code(403);
        $error = 'A sessão do formulário expirou. Tente novamente.';
    } elseif (!hash_equals($token, (string)($_POST['setup_token'] ?? ''))) {
        http_response_code(403);
        $error = 'Chave de configuração inválida.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 254 || strlen($password) < 12 || strlen($password) > 72 || $password !== (string)($_POST['confirm'] ?? '')) {
        http_response_code(422);
        $error = 'Informe um e-mail válido e confirme uma senha entre 12 e 72 caracteres.';
    } else {
        try {
            // A trava também impede a criação simultânea de duas primeiras contas.
            db()->query("SELECT GET_LOCK('jp_initial_setup', 5)")->fetchColumn() == 1 || throw new RuntimeException('Ocupado');
            try {
                if ((int)db()->query('SELECT COUNT(*) FROM jp_users')->fetchColumn() !== 0) {
                    throw new RuntimeException('Configurado');
                }
                $stmt = db()->prepare('INSERT INTO jp_users (email, password_hash) VALUES (?, ?)');
                $stmt->execute([$email, password_hash($password, PASSWORD_DEFAULT)]);
            } finally {
                db()->query("SELECT RELEASE_LOCK('jp_initial_setup')");
            }
            redirect('login.php');
        } catch (Throwable $e) {
            http_response_code(503);
            $error = 'Não foi possível criar a conta. Recarregue a página e tente novamente.';
        }
    }
}
require __DIR__ . '/app/auth-view.php';
