<?php
require 'auth.php';
requireLogin();

$content = trim($_POST['content'] ?? '');
$postId  = (int)($_POST['post_id'] ?? 0);

if ($content === '' || strlen($content) > 300 || !$postId) {
  die('Błąd danych');
}

$stmt = $pdo->prepare("
  INSERT INTO comments (post_id, user_id, content)
  VALUES (?, ?, ?)
");
$stmt->execute([
  $postId,
  currentUser()['id'],
  $content
]);

header('Location: /mikroblog.php');
