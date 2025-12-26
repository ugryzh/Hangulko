<?php
require 'api/auth.php';
requireLogin();

$user = currentUser();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title>Edycja profilu</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<?php require 'partials/navbar.php'; ?>

<section class="section">
<div class="container" style="max-width:720px">

<h2 class="mb-4">✏️ Edycja profilu</h2>

<form method="post" action="/api/profile_update.php" enctype="multipart/form-data">

  <!-- EMAIL -->
  <div class="mb-3">
    <label>Email</label>
    <input
      type="email"
      name="email"
      class="form-control"
      value="<?= htmlspecialchars($user['email'] ?? '') ?>"
      required
    >
  </div>

  <!-- AVATAR -->
  <div class="mb-3">
    <label>Avatar (250×250, max 250 KB)</label>
    <input type="file" name="avatar" class="form-control" accept="image/*">
  </div>

  <!-- HEADER -->
  <div class="mb-3">
    <label>Header profilu (800×200, max 300 KB)</label>
    <input type="file" name="header" class="form-control" accept="image/*">
  </div>

  <button class="btn btn-main">Zapisz zmiany</button>

</form>

</div>
</section>

<?php require 'partials/footer.php'; ?>
</body>
</html>
