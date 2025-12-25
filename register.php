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
<title>Rejestracja – Hangul Learn</title>
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
      <div class="col-md-6 col-lg-5">

        <div class="auth-card">
          <div class="text-center mb-4">
            <img src="assets/images/logo.svg" height="56" class="mb-2" alt="Hangulko">
            <h4>Załóż konto</h4>
            <p class="text-muted">Zacznij naukę alfabetu koreańskiego</p>
          </div>

          <form method="post" action="api/register.php">
            <div class="mb-3">
              <label class="form-label">Nazwa użytkownika</label>
              <input type="text" name="username" class="form-control" required maxlength="30">
            </div>

            <div class="mb-3">
              <label class="form-label">Adres email</label>
              <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Hasło</label>
              <input type="password" name="password" class="form-control" required>
            </div>

            <button class="btn btn-primary w-100">
              Zarejestruj się
            </button>
          </form>

          <div class="text-center mt-3">
            <small>
              Masz już konto?
              <a href="login.php">Zaloguj się</a>
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
