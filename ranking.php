<?php
require 'api/auth.php';

$users = $pdo->query("
  SELECT username, xp, level, premium_expire, avatar
  FROM users
  WHERE banned = 0
  ORDER BY xp DESC
  LIMIT 100
")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title>Ranking – Hangul Learn</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<?php require 'partials/navbar.php'; ?>

<section class="section">
<div class="container">

<h2 class="mb-4">🏆 Ranking użytkowników</h2>

<div class="card-box p-0">

<table class="table mb-0 align-middle">
<thead class="table-light">
<tr>
  <th>#</th>
  <th>Użytkownik</th>
  <th>Poziom</th>
  <th>XP</th>
</tr>
</thead>
<tbody>

<?php foreach ($users as $i => $u): ?>
<tr>
  <td><?= $i + 1 ?></td>

  <td class="d-flex align-items-center gap-2">
    <img
      src="/uploads/avatars/<?= htmlspecialchars($u['avatar'] ?? 'default.png') ?>"
      alt=""
      style="width:50px;height:50px;border-radius:50%;object-fit:cover;"
    >

    <a href="/u/<?= urlencode($u['username']) ?>" class="fw-semibold">
      <?= htmlspecialchars($u['username']) ?>
    </a>

    <?php if (!empty($u['premium_expire']) && strtotime($u['premium_expire']) > time()): ?>
      <span class="badge bg-success ms-1">Premium</span>
    <?php endif; ?>
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
