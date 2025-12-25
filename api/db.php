<?php
session_start();

$host = 'localhost';
$db   = 'hangul';      // ❗ MUSI BYĆ TA BAZA
$user = 'DB_USER';
$pass = 'DB_PASS';

$pdo = new PDO(
    "mysql:host=$host;dbname=$db;charset=utf8mb4",
    $user,
    $pass,
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]
);
