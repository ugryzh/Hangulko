<?php
require '../api/auth.php';
requireAdmin();

$stmt = $pdo->query("SELECT * FROM users ORDER BY created_at DESC");
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title>Użytkownicy – Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<?php require '../partials/navbar.php'; ?>

<div class="container mt-5">
<h3>👥 Użytkownicy</h3>

<table class="table table-dark table-hover mt-3">
<thead>
<tr>
  <th>ID</th>
  <th>Username</th>
  <th>Email</th>
  <th>Premium</th>
  <th>Ban</th>
  <th>Akcje</th>
</tr>
</thead>
<tbody>
<?php foreach ($users as $u): ?>
<tr>
  <td><?= $u['id'] ?></td>
  <td><?= htmlspecialchars($u['username']) ?></td>
  <td><?= htmlspecialchars($u['email']) ?></td>
  <td><?= $u['premium_expire'] && strtotime($u['premium_expire']) > time() ? '✔' : '—' ?></td>
  <td><?= $u['banned'] ? '🚫' : '—' ?></td>
  <td>
    <a href="users.php?ban=<?= $u['id'] ?>" class="btn btn-sm btn-danger">Ban</a>
    <a href="users.php?unban=<?= $u['id'] ?>" class="btn btn-sm btn-success">Unban</a>
  </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>

<?php require '../partials/footer.php'; ?>
</body>
</html>
