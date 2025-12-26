<?php
require_once __DIR__ . '/../api/auth.php';
$user = isLogged() ? currentUser() : null;
?>

<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container">

    <!-- LOGO / NAZWA -->
    <a class="navbar-brand" href="/index.php">
      Hangul Learn
    </a>

    <!-- TOGGLER -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- MENU -->
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">

        <li class="nav-item">
          <a class="nav-link" href="/ranking.php">Ranking</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/mikroblog.php">Mikroblog</a>
        </li>

        <?php if ($user): ?>

          <li class="nav-item">
            <a class="nav-link" href="/dashboard.php">Dashboard</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="/u/<?= urlencode($user['username']) ?>">
              Profil
            </a>
          </li>

          <?php if (isAdmin()): ?>
            <li class="nav-item">
              <a class="nav-link" href="/admin/index.php" style="color:#dc2626;">
                Admin
              </a>
            </li>
          <?php endif; ?>

          <li class="nav-item ms-lg-2">
            <a class="btn btn-outline" href="/logout.php">
              Wyloguj
            </a>
          </li>

        <?php else: ?>

          <!-- POPUP LOGOWANIE -->
          <li class="nav-item">
            <button
              class="btn btn-outline"
              onclick="openAuth('login')"
              type="button"
            >
              Logowanie
            </button>
          </li>

          <!-- POPUP REJESTRACJA -->
          <li class="nav-item ms-lg-1">
            <button
              class="btn btn-main"
              onclick="openAuth('register')"
              type="button"
            >
              Rejestracja
            </button>
          </li>

        <?php endif; ?>

      </ul>
    </div>

  </div>
</nav>
