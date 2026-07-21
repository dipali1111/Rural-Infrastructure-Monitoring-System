<?php
header('Content-Type: application/json');

require_once __DIR__ . '/db.php';

try {
    $pdo = getDbConnection();

    $pdo->exec(
        "CREATE TABLE IF NOT EXISTS reports (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(150) NOT NULL,
            location VARCHAR(150) NOT NULL,
            category VARCHAR(100) NOT NULL,
            description TEXT NOT NULL,
            status VARCHAR(50) NOT NULL DEFAULT 'Pending',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4"
    );

    $title = trim($_POST['title'] ?? '');
    $location = trim($_POST['location'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if ($title === '' || $location === '' || $category === '' || $description === '') {
        throw new InvalidArgumentException('All fields are required.');
    }

    $stmt = $pdo->prepare(
        'INSERT INTO reports (title, location, category, description, status) VALUES (?, ?, ?, ?, ?)' 
    );
    $stmt->execute([$title, $location, $category, $description, 'Pending']);

    echo json_encode([
        'success' => true,
        'message' => 'Report saved successfully.',
        'id' => $pdo->lastInsertId(),
    ]);
} catch (Throwable $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage(),
    ]);
}
?>
