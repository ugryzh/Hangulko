<?php
require 'api/auth.php';

$username = trim($_GET['u'] ?? '');

if ($username === '') {
    http_response_code(404);
    exit('Profil nie istnieje');
}

$stmt = $pdo->prepare("
  SELECT username, email, xp, level, premium_expire, created_at, avatar, header
  FROM users
  WHERE username = ? AND banned = 0
  LIMIT 1
");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    http_response_code(404);
    exit('Profil nie istnieje');
}

$isPremium = !empty($user['premium_expire']) && strtotime($user['premium_expire']) > time();
$avatar = $user['avatar'] ?: 'default.png';
?>

<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title>Profil <?= htmlspecialchars($user['username']) ?> – Hangul Learn</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/style.css">
<link rel="canonical" href="/u/<?= htmlspecialchars($user['username']) ?>">
</head>
<body>

<?php require 'partials/navbar.php'; ?>

<section class="section">
<div class="container">

<!-- HEADER -->
<?php if (!empty($user['header'])): ?>
  <div class="mb-4">
    <img
      src="/uploads/headers/<?= htmlspecialchars($user['header']) ?>"
      alt=""
      style="width:100%;max-height:200px;object-fit:cover;border-radius:14px;"
    >
  </div>
<?php endif; ?>

<!-- PROFIL -->
<div class="card-box text-center">

  <img
    src="/uploads/avatars/<?= htmlspecialchars($avatar) ?>"
    alt=""
    style="
      width:250px;
      height:250px;
      border-radius:50%;
      object-fit:cover;
      margin-top:-120px;
      border:6px solid #fff;
      background:#fff;
    "
  >

  <h2 class="mt-3 mb-1">
    <?= htmlspecialchars($user['username']) ?>
    <?php if ($isPremium): ?>
      <span class="badge bg-success">Premium</span>
    <?php endif; ?>
  </h2>

  <p class="text-muted mb-1">
    Poziom <?= (int)$user['level'] ?> • <?= (int)$user['xp'] ?> XP
  </p>

  <p class="text-muted">
    Użytkownik od <?= date('d.m.Y', strtotime($user['created_at'])) ?>
  </p>

  <?php if (isLogged() && currentUser()['username'] === $user['username']): ?>
    <a href="/profile_edit.php" class="btn btn-outline mt-3">
      Edytuj profil
    </a>
  <?php endif; ?>

</div>

</div>
</section>

<?php require 'partials/footer.php'; ?>
</body>
</html>
