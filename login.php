<?php
require 'api/auth.php';
if (isLogged()) {
  header('Location: dashboard.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title>Logowanie – Hangul Learn</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
<link rel="icon" type="image/svg+xml" href="assets/images/logo.svg">
</head>
<body>

<?php require 'partials/navbar.php'; ?>

<section class="auth-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5 col-lg-4">

        <div class="auth-card">
          <div class="text-center mb-4">
            <img src="assets/images/logo.svg" height="56" class="mb-2" alt="Hangulko">
            <h4>Zaloguj się</h4>
            <p class="text-muted">Wróć do nauki Hangula</p>
          </div>

          <form method="post" action="api/login.php">
            <div class="mb-3">
              <label class="form-label">Nazwa użytkownika</label>
              <input type="text" name="username" class="form-control" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Hasło</label>
              <input type="password" name="password" class="form-control" required>
            </div>

            <button class="btn btn-primary w-100">
              Zaloguj się
            </button>
          </form>

          <div class="text-center mt-3">
            <small>
              Nie masz konta?
              <a href="register.php">Zarejestruj się</a>
            </small>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<?php require 'partials/footer.php'; ?>
<?php require 'partials/cookie.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
