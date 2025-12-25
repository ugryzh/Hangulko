<?php
require 'api/auth.php';
if (!isLogged()) {
  header('Location: login.php');
  exit;
}

$user = $_SESSION['username'];
$isPremium = isPremium();
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

    <!-- POWITANIE -->
    <div class="mb-4">
      <h2>👋 Witaj, <span class="text-info"><?= htmlspecialchars($user) ?></span></h2>
      <p class="text-muted mb-0">
        Twoje centrum nauki alfabetu koreańskiego
      </p>
    </div>

    <!-- STATYSTYKI -->
    <div class="row g-4 mb-4">

      <div class="col-md-3">
        <div class="dash-card">
          <h6>🎖️ Poziom</h6>
          <strong>Poziom 1</strong>
          <small class="text-muted d-block">XP: 0 / 100</small>
        </div>
      </div>

      <div class="col-md-3">
        <div class="dash-card">
          <h6>🔥 Seria</h6>
          <strong>0 dni</strong>
          <small class="text-muted d-block">Ucz się codziennie</small>
        </div>
      </div>

      <div class="col-md-3">
        <div class="dash-card">
          <h6>🏆 Osiągnięcia</h6>
          <strong>0 / 100</strong>
          <small class="text-muted d-block">Zdobyte</small>
        </div>
      </div>

      <div class="col-md-3">
        <div class="dash-card">
          <h6>💎 Status</h6>
          <?php if ($isPremium): ?>
            <strong class="text-success">Premium</strong>
            <small class="text-muted d-block">Aktywne</small>
          <?php else: ?>
            <strong class="text-danger">Darmowe</strong>
            <small class="text-muted d-block">
              <a href="premium.php">Kup Premium</a>
            </small>
          <?php endif; ?>
        </div>
      </div>

    </div>

    <!-- AKCJE -->
    <div class="row g-4 mb-4">

      <div class="col-md-4">
        <div class="dash-action">
          <h5>🎮 Kontynuuj naukę</h5>
          <p>Wróć do gry i ćwicz Hangul.</p>
          <a href="game.php" class="btn btn-primary btn-sm">
            Graj
          </a>
        </div>
      </div>

      <div class="col-md-4">
        <div class="dash-action">
          <h5>📰 Mikroblog</h5>
          <p>Publikuj posty i komentuj.</p>
          <a href="mikroblog.php" class="btn btn-outline-info btn-sm">
            Przejdź
          </a>
        </div>
      </div>

      <div class="col-md-4">
        <div class="dash-action">
          <h5>👤 Profil</h5>
          <p>Zarządzaj swoim profilem.</p>
          <a href="profile.php?u=<?= urlencode($user) ?>" class="btn btn-outline-light btn-sm">
            Profil
          </a>
        </div>
      </div>

    </div>

    <!-- POSTĘP -->
    <div class="dash-progress">
      <h5>📈 Postęp nauki</h5>
      <p class="text-muted">
        Spółgłoski • Samogłoski • Sylaby
      </p>

      <div class="progress mb-2">
        <div class="progress-bar bg-info" style="width: 20%">20%</div>
      </div>

      <small class="text-muted">
        Ćwicz regularnie, aby odblokować nowe osiągnięcia
      </small>
    </div>

  </div>
</section>

<?php require 'partials/footer.php'; ?>
<?php require 'partials/cookie.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
