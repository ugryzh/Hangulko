<?php
require_once __DIR__ . '/../api/auth.php';
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-glass fixed-top">
  <div class="container">
    <a class="navbar-brand" href="/index.php">Hangul Learn</a>

    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">

        <?php if (isLogged()): ?>
          <li class="nav-item">
            <a class="nav-link" href="/dashboard.php">Dashboard</a>
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
        <?php endif; ?>

      </ul>
    </div>
  </div>
</nav>
