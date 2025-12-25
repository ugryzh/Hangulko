<?php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/premium.php';

if (!isLogged()) {
    http_response_code(401);
    exit('Brak autoryzacji');
}

$code = strtoupper(trim($_POST['code'] ?? ''));

if ($code === '') {
    http_response_code(400);
    exit('Brak kodu');
}

/* Pobierz kod */
$stmt = $pdo->prepare("
    SELECT *
    FROM coupons
    WHERE code = ?
      AND (expires_at IS NULL OR expires_at > NOW())
      AND used < max_uses
    LIMIT 1
");
$stmt->execute([$code]);
$coupon = $stmt->fetch();

if (!$coupon) {
    http_response_code(400);
    exit('Nieprawidłowy lub wykorzystany kod');
}

/* Zastosuj bonus dni */
if ((int)$coupon['bonus_days'] > 0) {
    addPremium($_SESSION['user_id'], (int)$coupon['bonus_days']);
}

/* Oznacz kod jako użyty */
$pdo->prepare("
    UPDATE coupons
    SET used = used + 1
    WHERE code = ?
")->execute([$code]);

/* 🔄 ODŚWIEŻ SESJĘ (KLUCZOWE) */
$stmt = $pdo->prepare("
    SELECT premium_expire
    FROM users
    WHERE id = ?
    LIMIT 1
");
$stmt->execute([$_SESSION['user_id']]);
$_SESSION['premium_expire'] = $stmt->fetchColumn();

/* (opcjonalnie) log admin / systemowy */
/*
$pdo->prepare("
    INSERT INTO admin_logs (admin_id, action)
    VALUES (?, ?)
")->execute([$_SESSION['user_id'], 'Użyto kodu: ' . $code]);
*/

echo 'Kod został poprawnie zastosowany';
