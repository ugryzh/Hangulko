<?php
require 'db.php';

header('Content-Type: application/json');

if (!isset($_POST['username'], $_POST['password'])) {
    echo json_encode([
        'success' => false,
        'error' => 'Brak danych'
    ]);
    exit;
}

$username = trim($_POST['username']);
$password = $_POST['password'];

/* WALIDACJA */
if (strlen($username) < 3 || strlen($username) > 30) {
    echo json_encode([
        'success' => false,
        'error' => 'Nazwa użytkownika musi mieć 3–30 znaków'
    ]);
    exit;
}

if (strlen($password) < 6) {
    echo json_encode([
        'success' => false,
        'error' => 'Hasło musi mieć min. 6 znaków'
    ]);
    exit;
}

/* SPRAWDŹ CZY ISTNIEJE */
$stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
$stmt->execute([$username]);
if ($stmt->fetch()) {
    echo json_encode([
        'success' => false,
        'error' => 'Użytkownik już istnieje'
    ]);
    exit;
}

/* REJESTRACJA */
$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("
    INSERT INTO users (username, password, created_at)
    VALUES (?, ?, NOW())
");
$stmt->execute([$username, $hash]);

/* AUTO LOGIN */
$_SESSION['user_id'] = $pdo->lastInsertId();

echo json_encode([
    'success' => true
]);
