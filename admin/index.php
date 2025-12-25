<?php
require '../api/auth.php';
requireAdmin();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title>Admin Panel – Hangul Learn</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<?php require '../partials/navbar.php'; ?>

<section class="dashboard-section">
  <div class="container">
    <h2>🛡️ Panel administratora</h2>
    <p class="text-muted">Zarządzanie platformą Hangul Learn</p>

    <div class="row g-4 mt-4">
      <div class="col-md-3">
        <a href="users.php" class="dash-action">👥 Użytkownicy</a>
      </div>
      <div class="col-md-3">
        <a href="coupons.php" class="dash-action">🎟️ Kody zniżkowe</a>
      </div>
      <div class="col-md-3">
        <a href="logs.php" class="dash-action">📜 Logi admina</a>
      </div>
    </div>
  </div>
</section>

<?php require '../partials/footer.php'; ?>
</body>
</html>
