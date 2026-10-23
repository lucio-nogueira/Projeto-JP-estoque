<?php
declare(strict_types=1);
require __DIR__ . '/app/bootstrap.php';
require_user();
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !valid_csrf($_POST['csrf'] ?? null)) {
    http_response_code(403);
    exit('Solicitação inválida.');
}
$_SESSION = [];
session_destroy();
setcookie(session_name(), '', ['expires' => time() - 3600, 'path' => base_path() . '/', 'secure' => (bool)$secure, 'httponly' => true, 'samesite' => 'Lax']);
redirect('login.php');
