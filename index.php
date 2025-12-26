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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<?php require 'partials/navbar.php'; ?>

<!-- =========================
     HERO
========================= -->
<section class="hero-section">
  <div class="container">
    <div class="row align-items-center g-5">

      <div class="col-md-6 animate">
        <h1 class="hero-title">
          Naucz się <span>Hangula</span><br>
          szybko i skutecznie
        </h1>

        <p class="hero-subtitle">
          Interaktywna nauka alfabetu koreańskiego, gry,
          ranking i społeczność uczących się 🇰🇷
        </p>

        <div class="mt-4">
          <?php if ($user): ?>
            <a href="/dashboard.php" class="btn btn-primary btn-lg me-2">
              Przejdź do dashboardu
            </a>
          <?php else: ?>
            <a href="#" onclick="openAuth('register')" class="btn btn-primary btn-lg me-2">
              Zacznij za darmo
            </a>
            <a href="#" onclick="openAuth('login')" class="btn btn-outline-info btn-lg">
              Zaloguj się
            </a>
          <?php endif; ?>
        </div>
      </div>

      <div class="col-md-6 text-center animate">
        <div class="hero-card">
          <div class="hangul-preview">한글</div>
          <p class="text-muted mt-3">
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
<section class="features-section">
  <div class="container">

    <h2 class="section-title text-center mb-5">
      Dlaczego Hangul Learn?
    </h2>

    <div class="row g-4">

      <div class="col-md-4">
        <div class="feature-card animate">
          <h5>🎮 Nauka przez grę</h5>
          <p>
            Ćwiczenia, testy i gry pomagają zapamiętać alfabet
            szybciej niż tradycyjna nauka.
          </p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="feature-card animate">
          <h5>🏆 Motywacja</h5>
          <p>
            Poziomy, XP, osiągnięcia i ranking
            motywują do regularnej nauki.
          </p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="feature-card animate">
          <h5>👥 Społeczność</h5>
          <p>
            Publiczne profile, mikroblog i komentarze
            tworzą aktywną społeczność uczących się.
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
