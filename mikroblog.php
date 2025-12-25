<?php
require 'api/auth.php';

$posts = $pdo->query("
  SELECT p.content, p.created_at, u.username
  FROM posts p
  JOIN users u ON u.id = p.user_id
  ORDER BY p.created_at DESC
")->fetchAll();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title>Mikroblog – Hangul Learn</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<?php require 'partials/navbar.php'; ?>

<section class="dashboard-section">
<div class="container">

<h2>📰 Mikroblog</h2>

<?php foreach ($posts as $p): ?>
  <div class="dash-card mb-3">
    <strong>
      <a href="/u/<?= urlencode($p['username']) ?>">
        <?= htmlspecialchars($p['username']) ?>
      </a>
    </strong>
    <p class="mb-1"><?= nl2br(htmlspecialchars($p['content'])) ?></p>
    <small class="text-muted"><?= $p['created_at'] ?></small>
  </div>
<?php endforeach; ?>

</div>
</section>

<?php require 'partials/footer.php'; ?>
</body>
</html>
