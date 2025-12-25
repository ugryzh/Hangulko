<?php
require_once '../api/auth.php';
requireAdmin();

/* DODAWANIE KODU */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo->prepare("
        INSERT INTO coupons (code, bonus_days, max_uses)
        VALUES (?, ?, ?)
    ")->execute([
        strtoupper(trim($_POST['code'])),
        (int)$_POST['days'],
        (int)$_POST['max_uses']
    ]);
}

/* LISTA */
$codes = $pdo->query("
  SELECT code, bonus_days, used, max_uses, expires_at
  FROM coupons
  ORDER BY created_at DESC
")->fetchAll();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title>Kody Premium – Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<?php require '../partials/navbar.php'; ?>

<div class="container mt-5">
<h3>🎟️ Kody premium</h3>

<form method="post" class="row g-2 mt-3">
  <div class="col-md-3">
    <input class="form-control" name="code" placeholder="KOD" required>
  </div>
  <div class="col-md-3">
    <input class="form-control" name="days" type="number" placeholder="Dni premium" required>
  </div>
  <div class="col-md-3">
    <input class="form-control" name="max_uses" type="number" placeholder="Limit użyć" required>
  </div>
  <div class="col-md-3">
    <button class="btn btn-primary w-100">Dodaj</button>
  </div>
</form>

<table class="table table-dark table-hover mt-4">
<thead>
<tr>
  <th>Kod</th>
  <th>Dni</th>
  <th>Użyto</th>
  <th>Limit</th>
</tr>
</thead>
<tbody>
<?php foreach ($codes as $c): ?>
<tr>
  <td><?= $c['code'] ?></td>
  <td><?= $c['bonus_days'] ?></td>
  <td><?= $c['used'] ?></td>
  <td><?= $c['max_uses'] ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>

<?php require '../partials/footer.php'; ?>
</body>
</html>
