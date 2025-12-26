<?php
require 'api/auth.php';

$username = trim($_GET['u'] ?? '');

if ($username === '') {
    http_response_code(404);
    exit('Profil nie istnieje');
}

/* POBIERZ PROFIL */
$stmt = $pdo->prepare("
  SELECT id, username, email, xp, level, premium_expire,
         created_at, avatar, header
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
</head>
<body>

<?php require 'partials/navbar.php'; ?>

<!-- =========================
     HEADER PROFILU
========================= -->
<div class="profile-cover">
  <?php if (!empty($user['header'])): ?>
    <img
      src="/uploads/headers/<?= htmlspecialchars($user['header']) ?>"
      alt="Header profilu"
    >
  <?php else: ?>
    <div class="profile-cover-placeholder"></div>
  <?php endif; ?>
</div>

<!-- =========================
     PROFIL
========================= -->
<section class="section">
<div class="container" style="max-width:900px">

<div class="profile-card">

  <!-- AVATAR -->
  <div class="profile-avatar-wrapper">
    <img
      src="/uploads/avatars/<?= htmlspecialchars($avatar) ?>"
      alt="Avatar"
      class="profile-avatar"
    >
  </div>

  <!-- INFO -->
  <div class="text-center mt-5">

    <h2 class="mb-1">
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

    <?php if (isLogged() && currentUser()['id'] === $user['id']): ?>
      <a href="/profile_edit.php" class="btn btn-outline mt-3">
        Edytuj profil
      </a>
    <?php endif; ?>

  </div>

</div>

<!-- =========================
     POSTY UŻYTKOWNIKA
========================= -->
<hr class="my-5">

<h4 class="mb-3">📝 Posty użytkownika</h4>

<?php
$stmt = $pdo->prepare("
  SELECT content, created_at
  FROM posts
  WHERE user_id = ?
  ORDER BY created_at DESC
");
$stmt->execute([$user['id']]);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php if (!$posts): ?>
  <p class="text-muted">Użytkownik nie dodał jeszcze żadnych postów.</p>
<?php endif; ?>

<?php foreach ($posts as $p): ?>
  <div class="card-box mb-3">
    <p><?= nl2br(htmlspecialchars($p['content'])) ?></p>
    <div class="text-muted" style="font-size:.85rem">
      <?= date('d.m.Y H:i', strtotime($p['created_at'])) ?>
    </div>
  </div>
<?php endforeach; ?>

</div>
</section>

<?php require 'partials/footer.php'; ?>
</body>
</html>
