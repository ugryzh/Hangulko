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

/* POBIERZ UŻYTKOWNIKA */
$stmt = $pdo->prepare("
    SELECT id, password
    FROM users
    WHERE username = ? AND banned = 0
    LIMIT 1
");
$stmt->execute([$username]);
$user = $stmt->fetch();

if (!$user || !password_verify($password, $user['password'])) {
    echo json_encode([
        'success' => false,
        'error' => 'Błędna nazwa użytkownika lub hasło'
    ]);
    exit;
}

/* ZAPIS SESJI */
$_SESSION['user_id'] = $user['id'];

echo json_encode([
    'success' => true
]);
