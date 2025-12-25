<?php
require_once 'db.php';

function isLogged() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isLogged() && $_SESSION['role'] === 'admin';
}

function isPremium() {
    return isLogged() && $_SESSION['premium_expire'] && strtotime($_SESSION['premium_expire']) > time();
}
