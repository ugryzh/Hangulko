<?php
require 'api/auth.php';
$logged = isLogged();
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

<!-- ===== NAVBAR (WSPÓLNY) ===== -->
<?php require 'partials/navbar.php'; ?>

<!-- ===== HERO ===== -->
<section class="hero-section">
  <div class="container text-center">
    <h1 class="hero-title">
      Naucz się alfabetu koreańskiego 🇰🇷
    </h1>

    <p class="hero-subtitle">
      Nowoczesna platforma do nauki Hangula po polsku.  
      Graj, zdobywaj osiągnięcia i ucz się skutecznie.
    </p>

    <div class="d-flex justify-content-center gap-3 mt-4 flex-wrap">
      <?php if($logged): ?>
        <a href="game.php" class="btn btn-primary btn-lg">
          Rozpocznij naukę
        </a>
        <a href="premium.php" class="btn btn-outline-info btn-lg">
          Premium
        </a>
      <?php else: ?>
        <a href="register.php" class="btn btn-primary btn-lg">
          Zacznij za darmo
        </a>
        <a href="login.php" class="btn btn-outline-light btn-lg">
          Mam konto
        </a>
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
          <p>
            Spółgłoski, samogłoski i sylaby w interaktywnej formie.
          </p>
        </div>
      </div>

      <div class="col-md-3">
        <div class="feature-card">
          <h5>🏆 Osiągnięcia</h5>
          <p>
            Achievementy, poziomy i ranking motywują do nauki.
          </p>
        </div>
      </div>

      <div class="col-md-3">
        <div class="feature-card">
          <h5>📰 Społeczność</h5>
          <p>
            Mikroblog, profile publiczne i komentarze użytkowników.
          </p>
        </div>
      </div>

      <div class="col-md-3">
        <div class="feature-card">
          <h5>💎 Premium</h5>
          <p>
            Brak reklam i pełen dostęp do wszystkich funkcji.
          </p>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ===== FOOTER (WSPÓLNY) ===== -->
<?php require 'partials/footer.php'; ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
