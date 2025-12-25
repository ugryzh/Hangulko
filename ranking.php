<?php
require 'api/auth.php';

$users = $pdo->query("
  SELECT username, xp, level, premium_expire
  FROM users
  WHERE banned = 0
  ORDER BY xp DESC
  LIMIT 100
")->fetchAll();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title>Ranking – Hangul Learn</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<?php require 'partials/navbar.php'; ?>

<section class="dashboard-section">
<div class="container">

<h2>🏆 Ranking</h2>

<div class="dash-card">
<table class="table table-hover">
<thead>
<tr><th>#</th><th>Użytkownik</th><th>Poziom</th><th>XP</th></tr>
</thead>
<tbody>
<?php foreach ($users as $i => $u): ?>
<tr>
  <td><?= $i+1 ?></td>
  <td>
    <a href="/u/<?= urlencode($u['username']) ?>">
      <?= htmlspecialchars($u['username']) ?>
    </a>
  </td>
  <td><?= (int)$u['level'] ?></td>
  <td><?= (int)$u['xp'] ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>

</div>
</section>

<?php require 'partials/footer.php'; ?>
</body>
</html>
