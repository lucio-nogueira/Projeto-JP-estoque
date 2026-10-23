<?php
declare(strict_types=1);
require __DIR__ . '/app/bootstrap.php';
$userId = require_user(true);
$method = $_SERVER['REQUEST_METHOD'];
if (!in_array($method, ['GET', 'PUT', 'DELETE', 'POST'], true)) {
    header('Allow: GET, PUT, DELETE, POST');
    json_response(['error' => 'Método não permitido.'], 405);
}
if ($method !== 'GET' && !valid_csrf($_SERVER['HTTP_X_CSRF_TOKEN'] ?? null)) {
    json_response(['error' => 'Solicitação inválida. Recarregue a página.'], 403);
}

function validate_record(string $collection, array $record): void
{
    if (!in_array($collection, ['produtos', 'movimentos'], true) || !is_string($record['id'] ?? null) || !preg_match('/^[a-zA-Z0-9_-]{1,80}$/D', $record['id'])) {
        throw new InvalidArgumentException('Registro inválido.');
    }
    if (strlen(json_encode($record, JSON_THROW_ON_ERROR)) > 131072) {
        throw new InvalidArgumentException('Registro muito grande.');
    }
    if ($collection === 'produtos') {
        if (!is_string($record['nome'] ?? null) || trim($record['nome']) === '' || strlen($record['nome']) > 320) {
            throw new InvalidArgumentException('Informe o nome do produto.');
        }
        if (isset($record['tamanhos']) && (!is_array($record['tamanhos']) || count($record['tamanhos']) > 60 || array_filter($record['tamanhos'], fn($t) => !is_string($t) || !preg_match('/^[0-9]{1,2}$/D', $t)))) {
            throw new InvalidArgumentException('Numerações inválidas.');
        }
    } elseif (!is_string($record['produtoId'] ?? null) || !preg_match('/^[a-zA-Z0-9_-]{1,80}$/D', $record['produtoId']) || !in_array($record['tipo'] ?? '', ['entrada', 'saida'], true) || !is_numeric($record['qtd'] ?? null) || !is_finite((float)$record['qtd']) || (float)$record['qtd'] <= 0) {
        throw new InvalidArgumentException('Movimentação inválida.');
    }
}

function save_record(int $userId, string $collection, array $record): void
{
    validate_record($collection, $record);
    if ($collection === 'movimentos') {
        $stmt = db()->prepare("SELECT 1 FROM jp_records WHERE user_id = ? AND collection = 'produtos' AND record_id = ?");
        $stmt->execute([$userId, $record['produtoId']]);
        if (!$stmt->fetchColumn()) throw new InvalidArgumentException('Produto não encontrado nesta conta.');
    }
    $stmt = db()->prepare('INSERT INTO jp_records (user_id, collection, record_id, payload) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE payload = VALUES(payload)');
    $stmt->execute([$userId, $collection, $record['id'], json_encode($record, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR)]);
}

function rollback_if_needed(): void
{
    try {
        if (db()->inTransaction()) db()->rollBack();
    } catch (Throwable $e) {
        // A conexão pode estar indisponível; a resposta não deve expor detalhes.
    }
}

try {
    if ($method === 'GET') {
        $result = ['produtos' => [], 'movimentos' => []];
        $stmt = db()->prepare('SELECT collection, payload FROM jp_records WHERE user_id = ?');
        $stmt->execute([$userId]);
        foreach ($stmt as $row) $result[$row['collection']][] = json_decode($row['payload'], true, 512, JSON_THROW_ON_ERROR);
        json_response($result);
    }
    if ((int)($_SERVER['CONTENT_LENGTH'] ?? 0) > 2097152) json_response(['error' => 'O arquivo excede o limite de 2 MB.'], 413);
    $raw = file_get_contents('php://input', false, null, 0, 2097153);
    if (strlen($raw) > 2097152) json_response(['error' => 'O arquivo excede o limite de 2 MB.'], 413);
    $body = $raw === '' ? [] : json_decode($raw, true, 64, JSON_THROW_ON_ERROR);
    if (!is_array($body)) throw new InvalidArgumentException('Dados inválidos.');
    if ($method === 'POST' && ($_GET['action'] ?? '') === 'batch') {
        if (!isset($body['records']) || !is_array($body['records']) || count($body['records']) < 1 || count($body['records']) > 256) throw new InvalidArgumentException('Operações inválidas.');
        db()->beginTransaction();
        $stmt = db()->prepare('SELECT id FROM jp_users WHERE id = ? FOR UPDATE');
        $stmt->execute([$userId]);
        foreach ($body['records'] as $item) {
            if (!is_array($item) || !is_string($item['collection'] ?? null) || !is_array($item['record'] ?? null)) throw new InvalidArgumentException('Registro inválido.');
            save_record($userId, $item['collection'], $item['record']);
        }
        db()->commit();
        json_response(['ok' => true]);
    }
    if ($method === 'POST' && ($_GET['action'] ?? '') === 'import') {
        if (!isset($body['produtos'], $body['movimentos']) || !is_array($body['produtos']) || !is_array($body['movimentos'])) throw new InvalidArgumentException('Backup inválido.');
        db()->beginTransaction();
        $stmt = db()->prepare('SELECT id FROM jp_users WHERE id = ? FOR UPDATE');
        $stmt->execute([$userId]);
        $stmt = db()->prepare('SELECT COUNT(*) FROM jp_records WHERE user_id = ?');
        $stmt->execute([$userId]);
        if ((int)$stmt->fetchColumn() !== 0) {
            db()->rollBack();
            json_response(['error' => 'A importação exige uma conta sem produtos ou movimentações.'], 409);
        }
        foreach (['produtos', 'movimentos'] as $collection) {
            foreach ($body[$collection] as $record) {
                if (!is_array($record)) throw new InvalidArgumentException('Backup inválido.');
                save_record($userId, $collection, $record);
            }
        }
        db()->commit();
        json_response(['ok' => true]);
    }
    $collection = (string)($_GET['collection'] ?? '');
    if (!in_array($collection, ['produtos', 'movimentos'], true)) throw new InvalidArgumentException('Coleção inválida.');
    db()->beginTransaction();
    $stmt = db()->prepare('SELECT id FROM jp_users WHERE id = ? FOR UPDATE');
    $stmt->execute([$userId]);
    if ($method === 'PUT') {
        save_record($userId, $collection, $body);
    } elseif ($method === 'DELETE') {
        $id = (string)($_GET['id'] ?? '');
        if (!preg_match('/^[a-zA-Z0-9_-]{1,80}$/D', $id)) throw new InvalidArgumentException('Registro inválido.');
        $stmt = db()->prepare('DELETE FROM jp_records WHERE user_id = ? AND collection = ? AND record_id = ?');
        $stmt->execute([$userId, $collection, $id]);
        if ($collection === 'produtos') {
            $stmt = db()->prepare("DELETE FROM jp_records WHERE user_id = ? AND collection = 'movimentos' AND JSON_UNQUOTE(JSON_EXTRACT(payload, '$.produtoId')) = ?");
            $stmt->execute([$userId, $id]);
        }
    } else {
        db()->rollBack();
        json_response(['error' => 'Operação inválida.'], 400);
    }
    db()->commit();
    json_response(['ok' => true]);
} catch (InvalidArgumentException | JsonException $e) {
    rollback_if_needed();
    json_response(['error' => 'Dados inválidos. Confira os campos e tente novamente.'], 422);
} catch (Throwable $e) {
    rollback_if_needed();
    json_response(['error' => 'Não foi possível acessar os dados. Tente novamente mais tarde.'], 503);
}
