<?php
require 'api/auth.php';
requireLogin();

$user = currentUser();

/* DNI PREMIUM */
$premiumDaysLeft = null;
if ($user && !empty($user['premium_expire'])) {
    $now = new DateTime();
    $exp = new DateTime($user['premium_expire']);
    $premiumDaysLeft = $exp > $now ? (int)$now->diff($exp)->format('%a') : 0;
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title>Dashboard – Hangul Learn</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<?php require 'partials/navbar.php'; ?>

<section class="dashboard-section">
<div class="container">

<h2>👋 Witaj, <?= htmlspecialchars($user['username']) ?></h2>
<p class="text-muted mb-4">Twoje centrum nauki Hangula</p>

<div class="row g-4 mb-4">

  <div class="col-md-3">
    <div class="dash-card">
      <h6>🎖️ Poziom</h6>
      <strong><?= (int)$user['level'] ?></strong><br>
      <small class="text-muted">XP: <?= (int)$user['xp'] ?></small>
    </div>
  </div>

  <div class="col-md-3">
    <div class="dash-card">
      <h6>💎 Premium</h6>
      <?php if ($premiumDaysLeft > 0): ?>
        <strong><?= $premiumDaysLeft ?></strong> dni
      <?php else: ?>
        <span class="text-danger">Brak</span><br>
        <a href="/premium.php" class="btn btn-outline-info btn-sm mt-1">Kup Premium</a>
      <?php endif; ?>
    </div>
  </div>

  <div class="col-md-3">
    <div class="dash-card">
      <h6>👤 Profil</h6>
      <a href="/u/<?= urlencode($user['username']) ?>" class="btn btn-outline-primary btn-sm">
        Zobacz profil
      </a>
    </div>
  </div>

</div>

</div>
</section>

<?php require 'partials/footer.php'; ?>
</body>
</html>
