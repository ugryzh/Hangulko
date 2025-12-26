<?php
require '../api/auth.php';
?>

<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title>Nauka Hangula – Hangul Learn</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<?php require '../partials/navbar.php'; ?>

<section class="section">
<div class="container text-center">

<h2 class="mb-5">📘 Nauka alfabetu Hangul</h2>

<div class="row justify-content-center g-4">

  <div class="col-md-4">
    <a href="consonants.php" class="learn-module d-block text-decoration-none">
      <h4>Spółgłoski</h4>
      <p>Poznaj podstawowe znaki Hangula</p>
    </a>
  </div>

  <div class="col-md-4">
    <a href="vowels.php" class="learn-module d-block text-decoration-none">
      <h4>Samogłoski</h4>
      <p>Fundament budowy sylab</p>
    </a>
  </div>

</div>

</div>
</section>

<?php require '../partials/footer.php'; ?>
</body>
</html>
