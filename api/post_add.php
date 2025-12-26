<?php
require 'auth.php';
requireLogin();

$content = trim($_POST['content'] ?? '');

if ($content === '' || strlen($content) > 500) {
  die('Nieprawidłowa treść');
}

$stmt = $pdo->prepare("
  INSERT INTO posts (user_id, content)
  VALUES (?, ?)
");
$stmt->execute([
  currentUser()['id'],
  $content
]);

header('Location: /mikroblog.php');
