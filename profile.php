<?php
require 'api/auth.php';

$username = trim($_GET['u'] ?? '');

if ($username === '') {
    http_response_code(404);
    exit('Profil nie istnieje');
}

/* POBIERZ UŻYTKOWNIKA */
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

/* PREMIUM */
$isPremium = $user['premium_expire'] && strtotime($user['premium_expire']) > time();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title>Profil <?= htmlspecialchars($user['username']) ?> – Hangul Learn</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/style.css">
<link rel="icon" type="image/svg+xml" href="/assets/images/logo.svg">
</head>
<body>

<?php require 'partials/navbar.php'; ?>

<section class="dashboard-section">
  <div class="container">

    <div class="dash-card text-center">

      <!-- AVATAR (NA RAZIE PLACEHOLDER) -->
      <div class="mb-3">
        <div style="
          width:96px;
          height:96px;
          border-radius:50%;
          background:#e5e7eb;
          margin:0 auto;
        "></div>
      </div>

      <h3>
        <?= htmlspecialchars($user['username']) ?>
        <?php if ($isPremium): ?>
          <span class="badge bg-success">Premium</span>
        <?php endif; ?>
      </h3>

      <p class="text-muted">
        Poziom <?= (int)$user['level'] ?> • <?= (int)$user['xp'] ?> XP
      </p>

      <p class="text-muted mb-0">
        Użytkownik od:
        <?= date('d.m.Y', strtotime($user['created_at'])) ?>
      </p>

    </div>

    <!-- MIEJSCE NA POSTY / AKTYWNOŚĆ -->
    <div class="dash-card mt-4">
      <h5>📰 Aktywność</h5>
      <p class="text-muted mb-0">
        Brak publicznych postów.
      </p>
    </div>

  </div>
</section>

<?php require 'partials/footer.php'; ?>
<?php require 'partials/cookie.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
