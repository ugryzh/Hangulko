<?php
require 'db.php';

/* Sprawdź czy premium aktywne */
function isPremiumActive($userId) {
  global $pdo;
  $stmt = $pdo->prepare("SELECT premium_expire FROM users WHERE id=?");
  $stmt->execute([$userId]);
  $date = $stmt->fetchColumn();
  return $date && strtotime($date) > time();
}

/* Dodaj / przedłuż premium */
function addPremium($userId, $days) {
  global $pdo;

  $stmt = $pdo->prepare("
    UPDATE users
    SET premium_expire =
      CASE
        WHEN premium_expire IS NULL OR premium_expire < NOW()
        THEN DATE_ADD(NOW(), INTERVAL ? DAY)
        ELSE DATE_ADD(premium_expire, INTERVAL ? DAY)
      END
    WHERE id=?
  ");
  $stmt->execute([$days, $days, $userId]);
}
