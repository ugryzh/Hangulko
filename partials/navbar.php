<?php
require_once __DIR__ . '/../api/auth.php';
$logged = isLogged();
$username = $logged ? $_SESSION['username'] : null;
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-glass fixed-top">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center gap-2" href="/index.php">
      <img src="/assets/images/logo.svg" class="logo-img" alt="Hangulko">
      <span class="brand-text">Hangul Learn</span>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
        <li class="nav-item">
          <a class="nav-link" href="/mikroblog.php">Mikroblog</a>
        </li>

        <?php if($logged): ?>
          <li class="nav-item">
            <a class="nav-link" href="/game.php">Graj</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/profile.php?u=<?= htmlspecialchars($username) ?>">Profil</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-outline-info btn-sm" href="/premium.php">Premium</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-outline-danger btn-sm" href="/logout.php">Wyloguj</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link" href="/login.php">Zaloguj</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-primary btn-sm" href="/register.php">Rejestracja</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
