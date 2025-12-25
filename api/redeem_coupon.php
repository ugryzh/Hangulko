<?php
require 'auth.php';
require 'premium.php';

if (!isLogged()) {
  http_response_code(401);
  exit;
}

$code = strtoupper(trim($_POST['code']));

$stmt = $pdo->prepare("
  SELECT * FROM coupons
  WHERE code=? AND (expires_at IS NULL OR expires_at > NOW())
  AND used < max_uses
");
$stmt->execute([$code]);
$coupon = $stmt->fetch();

if (!$coupon) {
  http_response_code(400);
  echo 'Nieprawidłowy kod';
  exit;
}

/* bonus dni */
if ($coupon['bonus_days'] > 0) {
  addPremium($_SESSION['user_id'], $coupon['bonus_days']);
}

/* oznacz jako użyty */
$pdo->prepare("
  UPDATE coupons SET used = used + 1 WHERE code=?
")->execute([$code]);

echo 'Kod zastosowany';
