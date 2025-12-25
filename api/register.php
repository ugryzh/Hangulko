<?php
require 'db.php';

$username = trim($_POST['username']);
$email    = trim($_POST['email']);
$password = $_POST['password'];

if(strlen($username) < 3 || strlen($username) > 30) {
    die('Nieprawidłowa nazwa użytkownika');
}

$hash = password_hash($password, PASSWORD_BCRYPT);

$stmt = $pdo->prepare(
    "INSERT INTO users (username, email, password) VALUES (?,?,?)"
);

try {
    $stmt->execute([$username, $email, $hash]);
    header("Location: ../login.php?registered=1");
} catch (PDOException $e) {
    die('Użytkownik już istnieje');
}
