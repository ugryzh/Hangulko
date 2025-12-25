<?php
require 'auth.php';
require 'premium.php';

if (!isLogged()) {
  http_response_code(401);
  exit;
}

$data = json_decode(file_get_contents('php://input'), true);

$days = (int)$data['days'];
$provider = $data['provider']; // paypal | revolut | code

if (!in_array($days, [7,14,30,365])) {
  http_response_code(400);
  exit;
}

/* zapis płatności */
$stmt = $pdo->prepare("
  INSERT INTO premium_payments (user_id, days, provider, status)
  VALUES (?, ?, ?, 'paid')
");
$stmt->execute([
  $_SESSION['user_id'],
  $days,
  $provider
]);

addPremium($_SESSION['user_id'], $days);

echo json_encode(['success'=>true]);
