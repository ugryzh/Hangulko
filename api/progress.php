<?php
require 'db.php';

$data = json_decode(file_get_contents('php://input'), true);

$stmt = $pdo->prepare(
  "INSERT INTO progress (user_id, symbol, correct, wrong)
   VALUES (?, ?, ?, ?)
   ON DUPLICATE KEY UPDATE
     correct = correct + VALUES(correct),
     wrong = wrong + VALUES(wrong)"
);
$stmt->execute([
  $_SESSION['user_id'],
  $data['symbol'],
  $data['correct'],
  $data['wrong']
]);

$pdo->prepare(
  "UPDATE users SET xp = xp + ? WHERE id = ?"
)->execute([
  $data['correct'] ? 10 : 0,
  $_SESSION['user_id']
]);
