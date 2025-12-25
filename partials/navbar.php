<?php
require_once __DIR__ . '/../api/auth.php';
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-glass fixed-top">
  <div class="container">
    <a class="navbar-brand" href="/index.php">Hangul Learn</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMain">
      <ul class="navbar-nav ms-auto">

        <li class="nav-item">
          <a class="nav-link" href="/ranking.php">Ranking</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/mikroblog.php">Mikroblog</a>
        </li>

        <?php if (isLogged()): ?>
          <li class="nav-item">
            <a class="nav-link" href="/dashboard.php">Dashboard</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="/u/<?= urlencode(currentUser()['username']) ?>">
              Profil
            </a>
          </li>

          <?php if (isAdmin()): ?>
            <li class="nav-item">
              <a class="nav-link text-warning" href="/admin/index.php">Admin</a>
            </li>
          <?php endif; ?>

          <li class="nav-item">
            <a class="nav-link" href="/logout.php">Wyloguj</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link" href="/login.php">Logowanie</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/register.php">Rejestracja</a>
          </li>
        <?php endif; ?>

      </ul>
    </div>
  </div>
</nav>
