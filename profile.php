<?php
require 'api/auth.php';

$username = $_GET['u'] ?? '';

$stmt = $pdo->prepare("
  SELECT username, xp, level, premium_expire, created_at
  FROM users
  WHERE username = ? AND banned = 0
  LIMIT 1
");
$stmt->execute([$username]);
$user = $stmt->fetch();

if (!$user) {
    http_response_code(404);
    exit('Profil nie istnieje');
}

$isPremium = $user['premium_expire'] && strtotime($user['premium_expire']) > time();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title>Profil <?= htmlspecialchars($user['username']) ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/style.css">
<link rel="canonical" href="/u/<?= htmlspecialchars($user['username']) ?>">
</head>
<body>

<?php require 'partials/navbar.php'; ?>

<section class="dashboard-section">
<div class="container">

<div class="dash-card text-center">
  <h3>
    <?= htmlspecialchars($user['username']) ?>
    <?php if ($isPremium): ?>
      <span class="badge bg-success">Premium</span>
    <?php endif; ?>
  </h3>

  <p class="text-muted">
    Poziom <?= (int)$user['level'] ?> • <?= (int)$user['xp'] ?> XP
  </p>

  <small class="text-muted">
    Użytkownik od <?= date('d.m.Y', strtotime($user['created_at'])) ?>
  </small>
</div>

</div>
</section>

<?php require 'partials/footer.php'; ?>
</body>
</html>
