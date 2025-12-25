<?php
require_once __DIR__ . '/db.php';

/**
 * Czy użytkownik jest zalogowany
 */
function isLogged(): bool {
    return isset($_SESSION['user_id']);
}

/**
 * Czy użytkownik jest administratorem
 */
function isAdmin(): bool {
    return isLogged() && ($_SESSION['role'] ?? 'user') === 'admin';
}

/**
 * Pobierz aktualnego użytkownika z bazy (ŹRÓDŁO PRAWDY)
 */
function currentUser(): ?array {
    global $pdo;

    if (!isLogged()) {
        return null;
    }

    $stmt = $pdo->prepare("
        SELECT id, username, email, xp, level, role, premium_expire, banned
        FROM users
        WHERE id = ?
        LIMIT 1
    ");
    $stmt->execute([$_SESSION['user_id']]);
    return $stmt->fetch();
}

/**
 * Czy użytkownik ma aktywne premium
 * ❗ DB jest źródłem prawdy, NIE sesja
 */
function isPremium(): bool {
    if (!isLogged()) {
        return false;
    }

    $user = currentUser();
    if (!$user || empty($user['premium_expire'])) {
        return false;
    }

    return strtotime($user['premium_expire']) > time();
}

/**
 * Wymuś zalogowanie
 */
function requireLogin(): void {
    if (!isLogged()) {
        header('Location: /login.php');
        exit;
    }
}

/**
 * Wymuś admina
 */
function requireAdmin(): void {
    if (!isAdmin()) {
        http_response_code(403);
        exit('Brak dostępu');
    }
}
