<?php
require_once __DIR__ . '/db.php';

/**
 * Dodaje lub przedłuża premium
 */
function addPremium(int $userId, int $days): void {
    global $pdo;

    if ($days <= 0) {
        return;
    }

    $stmt = $pdo->prepare("
        UPDATE users
        SET premium_expire =
          CASE
            WHEN premium_expire IS NULL OR premium_expire < NOW()
              THEN DATE_ADD(NOW(), INTERVAL :days DAY)
            ELSE DATE_ADD(premium_expire, INTERVAL :days DAY)
          END
        WHERE id = :uid
        LIMIT 1
    ");

    $stmt->execute([
        ':days' => $days,
        ':uid'  => $userId
    ]);
}
