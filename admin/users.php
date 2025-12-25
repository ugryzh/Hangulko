<?php
require_once '../api/auth.php';
requireAdmin();

$users = $pdo->query("
  SELECT id, username, email, role, banned
  FROM users
  ORDER BY created_at DESC
")->fetchAll();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title>Admin – Użytkownicy</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<?php require '../partials/navbar.php'; ?>

<section class="dashboard-section">
<div class="container">

<h2>👥 Użytkownicy</h2>

<div class="dash-card">
<table class="table table-hover">
<thead>
<tr><th>ID</th><th>Użytkownik</th><th>Email</th><th>Profil</th></tr>
</thead>
<tbody>
<?php foreach ($users as $u): ?>
<tr>
  <td><?= $u['id'] ?></td>
  <td><?= htmlspecialchars($u['username']) ?></td>
  <td><?= htmlspecialchars($u['email']) ?></td>
  <td>
    <a href="/u/<?= urlencode($u['username']) ?>" target="_blank">
      Zobacz
    </a>
  </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>

</div>
</section>

<?php require '../partials/footer.php'; ?>
</body>
</html>
