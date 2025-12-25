<?php
require 'api/auth.php';
$logged = isLogged();
$username = $logged ? $_SESSION['username'] : null;
?>
<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title>Hangul Learn – Nauka alfabetu koreańskiego</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link rel="stylesheet" href="assets/css/style.css">

<!-- Favicon -->
<link rel="icon" type="image/svg+xml" href="assets/images/logo.svg">
</head>
<body>

<!-- ===== NAVBAR ===== -->
<nav class="navbar navbar-expand-lg navbar-dark bg-glass fixed-top">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
      <img src="assets/images/logo.svg" class="logo-img" alt="Hangulko">
      <span class="brand-text">Hangul Learn</span>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
        <li class="nav-item"><a class="nav-link" href="mikroblog.php">Mikroblog</a></li>

        <?php if($logged): ?>
          <li class="nav-item"><a class="nav-link" href="game.php">Graj</a></li>
          <li class="nav-item"><a class="nav-link" href="profile.php?u=<?= htmlspecialchars($username) ?>">Profil</a></li>
          <li class="nav-item">
            <a class="btn btn-outline-info btn-sm" href="premium.php">Kup Premium</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-outline-danger btn-sm" href="logout.php">Wyloguj</a>
          </li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="login.php">Zaloguj</a></li>
          <li class="nav-item">
            <a class="btn btn-success btn-sm" href="register.php">Rejestracja</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<!-- ===== HERO ===== -->
<section class="hero-section">
  <div class="container text-center">
    <h1 class="hero-title">
      Naucz się alfabetu koreańskiego 🇰🇷
    </h1>
    <p class="hero-subtitle">
      Interaktywna nauka Hangula po polsku.  
      Graj, zdobywaj osiągnięcia i ucz się skutecznie.
    </p>

    <div class="d-flex justify-content-center gap-3 mt-4 flex-wrap">
      <?php if($logged): ?>
        <a href="game.php" class="btn btn-primary btn-lg">Rozpocznij naukę</a>
      <?php else: ?>
        <a href="register.php" class="btn btn-primary btn-lg">Zacznij za darmo</a>
        <a href="login.php" class="btn btn-outline-light btn-lg">Mam konto</a>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- ===== FEATURES ===== -->
<section class="features-section">
  <div class="container">
    <div class="row g-4 text-center">
      <div class="col-md-3">
        <div class="feature-card">
          <h5>🎮 Nauka przez grę</h5>
          <p>Spółgłoski, samogłoski i sylaby w formie gry.</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="feature-card">
          <h5>🏆 Osiągnięcia</h5>
          <p>Achievementy, poziomy i ranking.</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="feature-card">
          <h5>📰 Społeczność</h5>
          <p>Mikroblog, profile i komentarze.</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="feature-card">
          <h5>💎 Premium</h5>
          <p>Brak reklam i pełny dostęp.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== FOOTER ===== -->
<footer class="footer">
  <div class="container text-center">
    <img src="assets/images/logo.svg" height="32" class="mb-2">
    <p class="mb-0">© <?= date('Y') ?> Hangul Learn</p>
  </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
