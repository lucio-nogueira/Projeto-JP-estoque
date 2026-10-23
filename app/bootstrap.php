<?php
declare(strict_types=1);

ini_set('display_errors', '0');
ini_set('session.use_strict_mode', '1');
ini_set('session.use_only_cookies', '1');

function config(): array
{
    static $config;
    if ($config === null) {
        $path = getenv('JP_CONFIG_FILE') ?: dirname(__DIR__, 2) . '/jp-config.php';
        if (!is_file($path)) {
            $path = __DIR__ . '/config.local.php';
        }
        if (!is_file($path)) {
            throw new RuntimeException('Configuração do servidor pendente.');
        }
        $config = require $path;
        if (!is_array($config)) {
            throw new RuntimeException('Configuração inválida.');
        }
    }
    return $config;
}

function db(): PDO
{
    static $db;
    if (!$db) {
        $c = config();
        $db = new PDO($c['dsn'], $c['db_user'], $c['db_password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    }
    return $db;
}

function base_path(): string
{
    return rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/.');
}

function url(string $file): string
{
    return base_path() . '/' . $file;
}

function redirect(string $file): never
{
    header('Location: ' . url($file), true, 303);
    exit;
}

function h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

header('Cache-Control: no-store, private');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: same-origin');
header('X-Frame-Options: DENY');
$nonce = base64_encode(random_bytes(24));
header("Content-Security-Policy: default-src 'self'; script-src 'nonce-$nonce'; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; img-src 'self' data:; connect-src 'self'; base-uri 'none'; form-action 'self'; frame-ancestors 'none'");
try {
    $secure = config()['secure_cookies'] ?? true;
} catch (Throwable $e) {
    http_response_code(503);
    echo '<!doctype html><html lang="pt-BR"><meta charset="utf-8"><title>Configuração pendente</title><p>O site ainda precisa ser configurado pelo responsável pela hospedagem. Consulte o arquivo README.md do projeto.</p></html>';
    exit;
}
session_name('jp_session');
session_set_cookie_params([
    'lifetime' => 0,
    'path' => base_path() . '/',
    'secure' => (bool)$secure,
    'httponly' => true,
    'samesite' => 'Lax',
]);
session_start();
if ($secure) header('Strict-Transport-Security: max-age=31536000');
if (isset($_SESSION['user_id']) && (time() - ($_SESSION['last_seen'] ?? 0) > 1800 || time() - ($_SESSION['signed_in_at'] ?? 0) > 43200)) {
    $_SESSION = [];
    session_regenerate_id(true);
}
if (isset($_SESSION['user_id'])) {
    $_SESSION['last_seen'] = time();
}

function csrf_token(): string
{
    return $_SESSION['csrf'] ??= bin2hex(random_bytes(32));
}

function valid_csrf(mixed $token): bool
{
    return is_string($token) && isset($_SESSION['csrf']) && hash_equals($_SESSION['csrf'], $token);
}

function require_user(bool $api = false): int
{
    if (isset($_SESSION['user_id'])) {
        try {
            $stmt = db()->prepare('SELECT session_version FROM jp_users WHERE id = ?');
            $stmt->execute([(int)$_SESSION['user_id']]);
            $version = $stmt->fetchColumn();
            if ($version === false || (int)$version !== (int)($_SESSION['session_version'] ?? 0)) {
                $_SESSION = [];
                session_regenerate_id(true);
            }
        } catch (Throwable $e) {
            if ($api) json_response(['error' => 'Serviço temporariamente indisponível.'], 503);
            http_response_code(503);
            exit('Serviço temporariamente indisponível. Tente novamente mais tarde.');
        }
    }
    if (!isset($_SESSION['user_id'])) {
        if ($api) {
            json_response(['error' => 'Sua sessão expirou. Entre novamente.'], 401);
        }
        redirect('login.php');
    }
    return (int)$_SESSION['user_id'];
}

function json_response(array $data, int $status = 200): never
{
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    exit;
}

function consume_login_attempt(string $email): bool
{
    $bucket = (int)floor(time() / 900);
    $allowed = true;
    foreach ([['email:' . $email, 8], ['ip:' . ($_SERVER['REMOTE_ADDR'] ?? ''), 40]] as [$scope, $maximum]) {
        $key = hash('sha256', $scope . ':' . $bucket);
        $stmt = db()->prepare('INSERT INTO jp_login_limits (attempt_key, attempts, expires_at) VALUES (?, 1, ?) ON DUPLICATE KEY UPDATE attempts = attempts + 1');
        $stmt->execute([$key, ($bucket + 1) * 900]);
        $stmt = db()->prepare('SELECT attempts FROM jp_login_limits WHERE attempt_key = ?');
        $stmt->execute([$key]);
        $allowed = ((int)$stmt->fetchColumn() <= $maximum) && $allowed;
    }
    db()->prepare('DELETE FROM jp_login_limits WHERE expires_at < ?')->execute([time()]);
    return $allowed;
}
