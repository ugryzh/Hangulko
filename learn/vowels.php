<?php
require '../api/auth.php';

$stmt = $pdo->prepare("
  SELECT id, symbol, pronunciation
  FROM lessons
  WHERE type = 'vowel'
  ORDER BY id
");
$stmt->execute();
$letters = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title>Samogłoski – Hangul Learn</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<?php require '../partials/navbar.php'; ?>

<section class="section">
<div class="container">

<h3 class="mb-4">Samogłoski</h3>

<div class="row g-3">
<?php foreach ($letters as $l): ?>
  <div class="col-6 col-md-3">
    <a href="lesson.php?id=<?= $l['id'] ?>" class="card-box text-center d-block">
      <div style="font-size:3rem;font-weight:700">
        <?= htmlspecialchars($l['symbol']) ?>
      </div>
      <div class="text-muted">
        <?= htmlspecialchars($l['pronunciation']) ?>
      </div>
    </a>
  </div>
<?php endforeach; ?>
</div>

</div>
</section>

<?php require '../partials/footer.php'; ?>
</body>
</html>
