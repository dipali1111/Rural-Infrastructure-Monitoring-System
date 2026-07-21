<?php
header('Content-Type: application/json');

require_once __DIR__ . '/db.php';

try {
    $pdo = getDbConnection();
    $stmt = $pdo->query('SELECT * FROM reports ORDER BY created_at DESC');
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage(),
    ]);
}
?>
