<?php
require_once __DIR__ . '/db.php';

/* ===== LOGIN ===== */

function isLogged(): bool {
    return isset($_SESSION['user_id']);
}

function requireLogin(): void {
    if (!isLogged()) {
        header('Location: /login.php');
        exit;
    }
}

/* ===== ADMIN ===== */

function isAdmin(): bool {
    if (!isLogged()) return false;

    global $pdo;
    $stmt = $pdo->prepare("
        SELECT 1 FROM users
        WHERE id = ? AND role = 'admin'
        LIMIT 1
    ");
    $stmt->execute([$_SESSION['user_id']]);
    return (bool)$stmt->fetchColumn();
}

function requireAdmin(): void {
    if (!isAdmin()) {
        http_response_code(403);
        exit('Brak dostępu (admin)');
    }
}

/* ===== PREMIUM ===== */

function isPremium(): bool {
    if (!isLogged()) return false;

    global $pdo;
    $stmt = $pdo->prepare("
        SELECT 1 FROM users
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
        SELECT id, username, email, xp, level, role, premium_expire, banned
        FROM users
        WHERE id = ?
        LIMIT 1
    ");
    $stmt->execute([$_SESSION['user_id']]);
    return $stmt->fetch();
}
