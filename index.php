<?php
require 'api/auth.php';
$logged = isLogged();
$username = $logged ? $_SESSION['username'] : null;
?>
<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title>Hangul Learn – Nauka alfabetu koreańskiego</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header class="navbar">
  <div class="nav-left">
    <span class="logo">🇰🇷 Hangul Learn</span>
  </div>

  <nav class="nav-right">
    <a href="mikroblog.php">Mikroblog</a>

    <?php if($logged): ?>
      <a href="game.php">Graj</a>
      <a href="profile.php?u=<?= htmlspecialchars($username) ?>">Profil</a>
      <a href="premium.php" class="premium">Kup Premium</a>
      <a href="logout.php" class="danger">Wyloguj</a>
    <?php else: ?>
      <a href="login.php">Zaloguj</a>
      <a href="register.php" class="primary">Rejestracja</a>
    <?php endif; ?>
  </nav>
</header>

<main class="hero">
  <h1>Naucz się alfabetu koreańskiego 🇰🇷</h1>
  <p>
    Interaktywna platforma do nauki Hangula po polsku.  
    Graj, zdobywaj osiągnięcia i ucz się skutecznie.
  </p>

  <div class="hero-buttons">
    <?php if($logged): ?>
      <a href="game.php" class="btn primary">Rozpocznij naukę</a>
    <?php else: ?>
      <a href="register.php" class="btn primary">Zacznij za darmo</a>
      <a href="login.php" class="btn secondary">Mam konto</a>
    <?php endif; ?>
  </div>
</main>

<section class="features">
  <div class="feature">
    <h3>🎮 Nauka przez grę</h3>
    <p>Spółgłoski, samogłoski i sylaby w interaktywnej formie.</p>
  </div>
  <div class="feature">
    <h3>🏆 Osiągnięcia</h3>
    <p>Zdobywaj achievementy i rywalizuj w rankingu.</p>
  </div>
  <div class="feature">
    <h3>📰 Społeczność</h3>
    <p>Mikroblog, profile publiczne i komentarze.</p>
  </div>
  <div class="feature">
    <h3>💎 Premium</h3>
    <p>Brak reklam i pełny dostęp do wszystkich funkcji.</p>
  </div>
</section>

<footer class="footer">
  <p>© <?= date('Y') ?> Hangul Learn • Made with 🇰🇷</p>
</footer>

</body>
</html>
