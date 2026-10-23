<?php
declare(strict_types=1);
if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit;
}
require dirname(__DIR__) . '/app/bootstrap.php';
$email = strtolower(trim($argv[1] ?? ''));
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 254) {
    fwrite(STDERR, "Uso: php tools/manage-user.php email@exemplo.com\n");
    exit(1);
}
fwrite(STDERR, "Nova senha (12 a 72 caracteres; a entrada pode aparecer no terminal): ");
$password = rtrim((string)fgets(STDIN), "\r\n");
if (strlen($password) < 12 || strlen($password) > 72) {
    fwrite(STDERR, "Senha fora do tamanho permitido.\n");
    exit(1);
}
try {
    $stmt = db()->prepare('INSERT INTO jp_users (email, password_hash) VALUES (?, ?) ON DUPLICATE KEY UPDATE password_hash = VALUES(password_hash), session_version = session_version + 1');
    $stmt->execute([$email, password_hash($password, PASSWORD_DEFAULT)]);
    fwrite(STDOUT, "Conta criada ou senha atualizada.\n");
} catch (Throwable $e) {
    fwrite(STDERR, "Não foi possível atualizar a conta. Confira a configuração do banco.\n");
    exit(1);
}
