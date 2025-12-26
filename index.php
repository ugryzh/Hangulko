<?php
require 'api/auth.php';
$user = isLogged() ? currentUser() : null;
?>
<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title>Hangul Learn – Nauka alfabetu koreańskiego</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- GŁÓWNY CSS -->
<link rel="stylesheet" href="/assets/css/style.css">

</head>
<body>

<?php require 'partials/navbar.php'; ?>

<!-- =========================
     HERO SECTION
========================= -->
<section class="hero">
  <div class="container">
    <div class="row align-items-center">

      <div class="col-md-6">
        <h1>
          Nauka Hangula jest <span>쉬워요!</span>
        </h1>

        <p>
          Nowoczesna platforma do nauki alfabetu koreańskiego.
          Prosto, skutecznie i bez zbędnego chaosu 🇰🇷
        </p>

        <div class="hero-actions">
          <?php if ($user): ?>
            <a href="/dashboard.php" class="btn-main">
              Przejdź do nauki
            </a>
          <?php else: ?>
            <button class="btn-main" onclick="openAuth('register')">
              Zacznij za darmo
            </button>
            <button class="btn-outline" onclick="openAuth('login')">
              Logowanie
            </button>
          <?php endif; ?>
        </div>
      </div>

      <div class="col-md-6 text-center">
        <div class="card-box">
          <div style="font-size:3.5rem;font-weight:900;color:#dc2626;">
            쉬워요!
          </div>
          <p class="mt-3 text-muted">
            Spółgłoski • Samogłoski • Sylaby
          </p>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- =========================
     FEATURES
========================= -->
<section class="section">
  <div class="container">
    <div class="row g-4">

      <div class="col-md-4">
        <div class="card-box">
          <h5>🎮 Nauka przez grę</h5>
          <p class="text-muted">
            Uczysz się przez interaktywne ćwiczenia
            zamiast nudnych tabel.
          </p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card-box">
          <h5>🏆 Motywacja</h5>
          <p class="text-muted">
            Poziomy, XP i osiągnięcia
            utrzymują regularność nauki.
          </p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card-box">
          <h5>👥 Społeczność</h5>
          <p class="text-muted">
            Profile użytkowników, mikroblog
            i wspólna nauka Hangula.
          </p>
        </div>
      </div>

    </div>
  </div>
</section>

<?php require 'partials/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
