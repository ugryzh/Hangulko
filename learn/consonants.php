<?php
require '../api/auth.php';

$stmt = $pdo->prepare("
  SELECT id, symbol, pronunciation
  FROM lessons
  WHERE type = 'consonant'
  ORDER BY id
");
$stmt->execute();
$letters = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title>Spółgłoski – Hangul Learn</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<?php require '../partials/navbar.php'; ?>

<section class="section">
<div class="container">

<h3 class="mb-4">Spółgłoski</h3>

<div class="learn-grid">
<?php foreach ($letters as $l): ?>
  <a href="lesson.php?id=<?= $l['id'] ?>" class="learn-tile">
    <div class="learn-symbol"><?= htmlspecialchars($l['symbol']) ?></div>
    <div class="learn-pron"><?= htmlspecialchars($l['pronunciation']) ?></div>
  </a>
<?php endforeach; ?>
</div>

</div>
</section>

<?php require '../partials/footer.php'; ?>
</body>
</html>
