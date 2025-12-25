<?php
require 'api/auth.php';
requireLogin();

$user = currentUser();

/* LICZENIE DNI PREMIUM */
$premiumDaysLeft = null;

if ($user && !empty($user['premium_expire'])) {
    $now = new DateTime();
    $expire = new DateTime($user['premium_expire']);

    if ($expire > $now) {
        $premiumDaysLeft = (int)$now->diff($expire)->format('%a');
    } else {
        $premiumDaysLeft = 0;
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title>Dashboard – Hangul Learn</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
<link rel="icon" type="image/svg+xml" href="assets/images/logo.svg">
</head>
<body>

<?php require 'partials/navbar.php'; ?>

<section class="dashboard-section">
  <div class="container">

    <h2 class="mb-1">
      👋 Witaj, <?= htmlspecialchars($user['username']) ?>
    </h2>
    <p class="text-muted mb-4">
      Twoje centrum nauki alfabetu koreańskiego
    </p>

    <!-- STATYSTYKI -->
    <div class="row g-4 mb-4">

      <div class="col-md-3">
        <div class="dash-card">
          <h6>🎖️ Poziom</h6>
          <strong>Poziom <?= $user['level'] ?></strong><br>
          <small class="text-muted">XP: <?= $user['xp'] ?></small>
        </div>
      </div>

      <div class="col-md-3">
        <div class="dash-card">
          <h6>🏆 Osiągnięcia</h6>
          <strong>0 / 100</strong>
          <small class="text-muted d-block">Do zdobycia</small>
        </div>
      </div>

      <div class="col-md-3">
        <div class="dash-card">
          <h6>💎 Premium</h6>

          <?php if ($premiumDaysLeft !== null && $premiumDaysLeft > 0): ?>
            <table class="table table-sm mb-0">
              <tr>
                <td>Status</td>
                <td class="text-success">Aktywne</td>
              </tr>
              <tr>
                <td>Pozostało</td>
                <td><strong><?= $premiumDaysLeft ?></strong> dni</td>
              </tr>
              <tr>
                <td>Do dnia</td>
                <td><?= date('d.m.Y', strtotime($user['premium_expire'])) ?></td>
              </tr>
            </table>
          <?php else: ?>
            <p class="text-danger mb-2">Brak Premium</p>
            <a href="premium.php" class="btn btn-outline-info btn-sm">
              Kup Premium
            </a>
          <?php endif; ?>
        </div>
      </div>

      <div class="col-md-3">
        <div class="dash-card">
          <h6>👤 Konto</h6>
          <a href="profile.php?u=<?= urlencode($user['username']) ?>" class="btn btn-outline-primary btn-sm">
            Profil
          </a>
        </div>
      </div>

    </div>

    <!-- AKCJE -->
    <div class="row g-4">

      <div class="col-md-4">
        <div class="dash-action">
          <h5>🎮 Graj</h5>
          <p class="text-muted">Kontynuuj naukę Hangula</p>
          <a href="game.php" class="btn btn-primary btn-sm">Start</a>
        </div>
      </div>

      <div class="col-md-4">
        <div class="dash-action">
          <h5>📰 Mikroblog</h5>
          <p class="text-muted">Posty i społeczność</p>
          <a href="mikroblog.php" class="btn btn-outline-info btn-sm">Przejdź</a>
        </div>
      </div>

      <div class="col-md-4">
        <div class="dash-action">
          <h5>📊 Ranking</h5>
          <p class="text-muted">Najlepsi uczniowie</p>
          <a href="ranking.php" class="btn btn-outline-secondary btn-sm">Zobacz</a>
        </div>
      </div>

    </div>

  </div>
</section>

<?php require 'partials/footer.php'; ?>
<?php require 'partials/cookie.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
