<?php
require 'api/auth.php';
if (!isLogged()) {
  header('Location: login.php');
  exit;
}

$isPremium = isPremium();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title>Premium – Hangul Learn</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
<link rel="icon" type="image/svg+xml" href="assets/images/logo.svg">
</head>
<body>

<?php require 'partials/navbar.php'; ?>

<section class="premium-section">
  <div class="container text-center">

    <h1 class="premium-title">💎 Hangul Learn Premium</h1>
    <p class="premium-subtitle">
      Odblokuj pełny dostęp do nauki alfabetu koreańskiego
    </p>

    <?php if ($isPremium): ?>
      <div class="alert alert-success mt-4">
        🎉 Masz aktywne <strong>Premium</strong>. Dziękujemy za wsparcie!
      </div>
    <?php endif; ?>

    <!-- PLANY -->
    <div class="row g-4 mt-4 justify-content-center">

      <!-- 7 dni -->
      <div class="col-md-3">
        <div class="premium-card">
          <h5>7 dni</h5>
          <div class="price">9 zł</div>
          <ul>
            <li>Pełna gra</li>
            <li>Brak reklam</li>
            <li>Achievementy</li>
          </ul>
          <button class="btn btn-primary btn-sm">
            Kup 7 dni
          </button>
        </div>
      </div>

      <!-- 14 dni -->
      <div class="col-md-3">
        <div class="premium-card featured">
          <h5>14 dni</h5>
          <div class="price">15 zł</div>
          <ul>
            <li>Pełny dostęp</li>
            <li>Brak reklam</li>
            <li>Ranking</li>
          </ul>
          <button class="btn btn-primary btn-sm">
            Kup 14 dni
          </button>
        </div>
      </div>

      <!-- 30 dni -->
      <div class="col-md-3">
        <div class="premium-card">
          <h5>30 dni</h5>
          <div class="price">29 zł</div>
          <ul>
            <li>Wszystkie funkcje</li>
            <li>Statystyki</li>
            <li>Powtórki błędów</li>
          </ul>
          <button class="btn btn-primary btn-sm">
            Kup 30 dni
          </button>
        </div>
      </div>

      <!-- 365 dni -->
      <div class="col-md-3">
        <div class="premium-card best">
          <h5>365 dni</h5>
          <div class="price">99 zł</div>
          <ul>
            <li>Rok nauki</li>
            <li>Najlepsza cena</li>
            <li>Priorytet</li>
          </ul>
          <button class="btn btn-success btn-sm">
            Kup 365 dni
          </button>
        </div>
      </div>

    </div>

    <!-- KOD ZNIŻKOWY -->
    <div class="coupon-box mt-5">
      <h6>🎟️ Masz kod zniżkowy?</h6>
      <form class="d-flex justify-content-center gap-2 mt-2">
        <input type="text" class="form-control w-25" placeholder="Wpisz kod">
        <button class="btn btn-outline-info btn-sm">
          Zastosuj
        </button>
      </form>
    </div>

    <!-- PŁATNOŚCI -->
    <div class="payments mt-5">
      <p class="text-muted mb-2">Dostępne metody płatności</p>
      <span class="badge bg-primary">PayPal</span>
      <span class="badge bg-info">Revolut</span>
    </div>

  </div>
</section>

<?php require 'partials/footer.php'; ?>
<?php require 'partials/cookie.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

