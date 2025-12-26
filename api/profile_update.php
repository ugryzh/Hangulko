<?php
require 'auth.php';
requireLogin();

$user = currentUser();

/* EMAIL */
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  die('Nieprawidłowy email');
}

/* FUNKCJA UPLOADU */
function uploadImage($file, $dir, $maxSize, $maxW, $maxH) {
  if ($file['error'] !== UPLOAD_ERR_OK) return null;
  if ($file['size'] > $maxSize) die('Plik za duży');

  [$w, $h] = getimagesize($file['tmp_name']);
  if ($w > $maxW || $h > $maxH) die('Nieprawidłowy rozmiar obrazu');

  $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
  $name = uniqid() . '.' . $ext;

  move_uploaded_file($file['tmp_name'], __DIR__ . '/../uploads/' . $dir . '/' . $name);
  return $name;
}

/* AVATAR */
$avatar = uploadImage(
  $_FILES['avatar'] ?? [],
  'avatars',
  250 * 1024,
  250,
  250
);

/* HEADER */
$header = uploadImage(
  $_FILES['header'] ?? [],
  'headers',
  300 * 1024,
  800,
  200
);

/* UPDATE */
$sql = "UPDATE users SET email = ?";
$params = [$_POST['email']];

if ($avatar) {
  $sql .= ", avatar = ?";
  $params[] = $avatar;
}

if ($header) {
  $sql .= ", header = ?";
  $params[] = $header;
}

$sql .= " WHERE id = ?";
$params[] = $user['id'];

$stmt = $pdo->prepare($sql);
$stmt->execute($params);

header('Location: /u/' . urlencode($user['username']));
