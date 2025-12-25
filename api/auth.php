<?php
require_once __DIR__ . '/db.php';

/* ===== AUTH CORE ===== */

function isLogged(): bool {
    return isset($_SESSION['user_id']);
}

function requireLogin(): void {
    if (!isLogged()) {
        header('Location: /login.php');
        exit;
    }
}

function isAdmin(): bool {
    if (!isLogged()) return false;

    global $pdo;
    $stmt = $pdo->prepare("SELECT role FROM users WHERE id=? LIMIT 1");
    $stmt->execute([$_SESSION['user_id']]);
    return $stmt->fetchColumn() === 'admin';
}

/* ===== PREMIUM — JEDYNE ŹRÓDŁO PRAWDY ===== */

function isPremium(): bool {
    if (!isLogged()) return false;

    global $pdo;
    $stmt = $pdo->prepare("
        SELECT 1
        FROM users
        WHERE id = ?
          AND premium_expire IS NOT NULL
          AND premium_expire > NOW()
        LIMIT 1
    ");
    $stmt->execute([$_SESSION['user_id']]);
    return (bool)$stmt->fetchColumn();
}

/* ===== USER ===== */

function currentUser(): ?array {
    if (!isLogged()) return null;

    global $pdo;
    $stmt = $pdo->prepare("
        SELECT id, username, email, xp, level, role, premium_expire
        FROM users
        WHERE id = ?
        LIMIT 1
    ");
    $stmt->execute([$_SESSION['user_id']]);
    return $stmt->fetch();
}
