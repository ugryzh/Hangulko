<?php
require 'api/auth.php';

$posts = $pdo->query("
  SELECT p.id, p.content, p.created_at,
         u.username, u.avatar
  FROM posts p
  JOIN users u ON u.id = p.user_id
  WHERE u.banned = 0
  ORDER BY p.created_at DESC
  LIMIT 50
")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title>Mikroblog – Hangul Learn</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<?php require 'partials/navbar.php'; ?>

<section class="section">
<div class="container" style="max-width:800px">

<h2 class="mb-4">📝 Mikroblog</h2>

<!-- DODAWANIE POSTA -->
<?php if (isLogged()): ?>
<form method="post" action="/api/post_add.php" class="card-box mb-4">
  <textarea
    name="content"
    class="form-control mb-2"
    placeholder="Co nowego?"
    maxlength="500"
    required
  ></textarea>
  <button class="btn btn-main">Opublikuj</button>
</form>
<?php else: ?>
<p class="text-muted">Zaloguj się, aby dodać post.</p>
<?php endif; ?>

<!-- POSTY -->
<?php foreach ($posts as $post): ?>
<div class="card-box mb-3">

  <div class="d-flex align-items-center gap-2 mb-2">
    <img
      src="/uploads/avatars/<?= htmlspecialchars($post['avatar'] ?? 'default.png') ?>"
      style="width:40px;height:40px;border-radius:50%;object-fit:cover;"
    >
    <a href="/u/<?= urlencode($post['username']) ?>" class="fw-semibold">
      <?= htmlspecialchars($post['username']) ?>
    </a>
    <span class="text-muted ms-auto" style="font-size:.85rem">
      <?= date('d.m.Y H:i', strtotime($post['created_at'])) ?>
    </span>
  </div>

  <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>

  <!-- KOMENTARZE -->
  <?php
  $stmt = $pdo->prepare("
    SELECT c.content, c.created_at, u.username
    FROM comments c
    JOIN users u ON u.id = c.user_id
    WHERE c.post_id = ?
    ORDER BY c.created_at ASC
  ");
  $stmt->execute([$post['id']]);
  $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
  ?>

  <?php foreach ($comments as $c): ?>
    <div class="ms-4 text-muted" style="font-size:.9rem">
      <strong><?= htmlspecialchars($c['username']) ?>:</strong>
      <?= htmlspecialchars($c['content']) ?>
    </div>
  <?php endforeach; ?>

  <?php if (isLogged()): ?>
  <form method="post" action="/api/comment_add.php" class="mt-2">
    <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
    <input
      type="text"
      name="content"
      class="form-control"
      placeholder="Dodaj komentarz..."
      maxlength="300"
      required
    >
  </form>
  <?php endif; ?>

</div>
<?php endforeach; ?>

</div>
</section>

<?php require 'partials/footer.php'; ?>
</body>
</html>
