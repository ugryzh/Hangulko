<?php
require_once 'db.php';

function isLogged(): bool {
    return isset($_SESSION['user_id']);
}

function isAdmin(): bool {
    return isLogged() && $_SESSION['role'] === 'admin';
}

function isPremium(): bool {
    return isLogged()
        && !empty($_SESSION['premium_expire'])
        && strtotime($_SESSION['premium_expire']) > time();
}
