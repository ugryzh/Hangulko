<?php
require '../api/auth.php';

$id = (int)($_GET['id'] ?? 0);

$stmt = $pdo->prepare("
  SELECT id, symbol, pronunciation, description_pl, audio
  FROM lessons
  WHERE id = ?
");
$stmt->execute([$id]);
$l = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$l) {
  http_response_code(404);
  exit('Nie znaleziono lekcji');
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title><?= htmlspecialchars($l['symbol']) ?> – Nauka Hangula</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<?php require '../partials/navbar.php'; ?>

<section class="section">
<div class="container" style="max-width:650px">

<div class="lesson-card text-center">

  <div class="lesson-symbol">
    <?= htmlspecialchars($l['symbol']) ?>
  </div>

  <div class="lesson-pron">
    <?= htmlspecialchars($l['pronunciation']) ?>
  </div>

  <div class="lesson-desc">
    <?= htmlspecialchars($l['description_pl']) ?>
  </div>

  <?php if ($l['audio']): ?>
    <div class="lesson-audio">
      <audio controls src="/audio/<?= htmlspecialchars($l['audio']) ?>"></audio>
    </div>
  <?php endif; ?>

</div>

</div>
</section>

<?php require '../partials/footer.php'; ?>
</body>
</html>
