<?php
require '../api/auth.php';
requireAdmin();

$logs = $pdo->query("
  SELECT l.*, u.username
  FROM admin_logs l
  JOIN users u ON u.id = l.admin_id
  ORDER BY l.created_at DESC
")->fetchAll();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title>Logi admina</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<?php require '../partials/navbar.php'; ?>

<div class="container mt-5">
<h3>📜 Logi administratora</h3>

<table class="table table-dark table-hover mt-3">
<tr>
<th>Admin</th><th>Akcja</th><th>Data</th>
</tr>
<?php foreach ($logs as $l): ?>
<tr>
<td><?= htmlspecialchars($l['username']) ?></td>
<td><?= htmlspecialchars($l['action']) ?></td>
<td><?= $l['created_at'] ?></td>
</tr>
<?php endforeach; ?>
</table>
</div>

<?php require '../partials/footer.php'; ?>
</body>
</html>
