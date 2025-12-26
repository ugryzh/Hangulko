<?php
require '../api/auth.php';

$id = (int)($_GET['id'] ?? 0);

$stmt = $pdo->prepare("
  SELECT symbol, pronunciation, description_pl, audio
  FROM lessons
  WHERE id = ?
");
$stmt->execute([$id]);
$l = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$l) {
  exit('Nie znaleziono znaku');
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title><?= htmlspecialchars($l['symbol']) ?> – Hangul Learn</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<?php require '../partials/navbar.php'; ?>

<section class="section">
<div class="container text-center" style="max-width:600px">

<div class="card-box">
  <div style="font-size:5rem;font-weight:800">
    <?= htmlspecialchars($l['symbol']) ?>
  </div>

  <h4><?= htmlspecialchars($l['pronunciation']) ?></h4>

  <p class="text-muted mt-3">
    <?= htmlspecialchars($l['description_pl']) ?>
  </p>

  <?php if ($l['audio']): ?>
    <audio controls src="/audio/<?= htmlspecialchars($l['audio']) ?>"></audio>
  <?php endif; ?>
</div>

</div>
</section>

<?php require '../partials/footer.php'; ?>
</body>
</html>
