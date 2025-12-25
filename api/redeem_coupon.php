<?php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/premium.php';

requireLogin();

$code = strtoupper(trim($_POST['code'] ?? ''));

if ($code === '') {
    http_response_code(400);
    exit('Brak kodu');
}

$stmt = $pdo->prepare("
    SELECT * FROM coupons
    WHERE code = ?
      AND (expires_at IS NULL OR expires_at > NOW())
      AND used < max_uses
    LIMIT 1
");
$stmt->execute([$code]);
$coupon = $stmt->fetch();

if (!$coupon) {
    http_response_code(400);
    exit('Nieprawidłowy kod');
}

addPremium($_SESSION['user_id'], (int)$coupon['bonus_days']);

$pdo->prepare("
    UPDATE coupons
    SET used = used + 1
    WHERE code = ?
")->execute([$code]);

echo 'OK';
