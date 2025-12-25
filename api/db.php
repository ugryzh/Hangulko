<?php
// api/db.php
$host = 'localhost';
$db   = 'hangul';
$user = 'DB_USER';
$pass = 'DB_PASS';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8mb4",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die('Błąd połączenia z bazą danych');
}

session_start();
