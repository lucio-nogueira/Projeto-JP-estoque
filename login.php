<?php
declare(strict_types=1);
require __DIR__ . '/app/bootstrap.php';
if (isset($_SESSION['user_id'])) redirect('index.php');
$title = 'Entre na sua conta';
$description = 'Acesse seu estoque e acompanhe suas movimentações.';
$error = '';
$email = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = strtolower(trim((string)($_POST['email'] ?? '')));
    $password = (string)($_POST['password'] ?? '');
    if (!valid_csrf($_POST['csrf'] ?? null)) {
        http_response_code(403);
        $error = 'A sessão do formulário expirou. Tente novamente.';
    } else {
        try {
            if (!consume_login_attempt($email)) {
                http_response_code(429);
                $error = 'Muitas tentativas. Aguarde 15 minutos antes de tentar novamente.';
            } else {
                $stmt = db()->prepare('SELECT id, email, password_hash, session_version FROM jp_users WHERE email = ?');
                $stmt->execute([$email]);
                $user = $stmt->fetch();
                // Hash de comparação para manter a verificação quando a conta não existe.
                $dummy = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi.';
                $valid = password_verify($password, $user['password_hash'] ?? $dummy);
                if (!$user || !$valid || strlen($password) > 72) {
                    http_response_code(401);
                    $error = 'E-mail ou senha incorretos.';
                } else {
                    $key = hash('sha256', 'email:' . $email . ':' . (int)floor(time() / 900));
                    db()->prepare('DELETE FROM jp_login_limits WHERE attempt_key = ?')->execute([$key]);
                    session_regenerate_id(true);
                    $_SESSION = ['user_id' => (int)$user['id'], 'email' => $user['email'], 'session_version' => (int)$user['session_version'], 'signed_in_at' => time(), 'last_seen' => time()];
                    csrf_token();
                    redirect('index.php');
                }
            }
        } catch (Throwable $e) {
            http_response_code(503);
            $error = 'Não foi possível entrar agora. Tente novamente mais tarde.';
        }
    }
}
require __DIR__ . '/app/auth-view.php';
