<?php
require_once __DIR__ . '/../api/auth.php';

/* Opcjonalnie: premium nie widzi cookie popupu */
if (isLogged() && isPremium()) {
  return;
}
?>

<div id="cookieNotice" class="cookie-notice d-none">
  <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
    <div class="cookie-text">
      🍪 Ta strona używa plików cookies w celach statystycznych i funkcjonalnych.
      Korzystając z serwisu akceptujesz ich użycie.
    </div>
    <button class="btn btn-primary btn-sm" onclick="acceptCookies()">
      Akceptuję
    </button>
  </div>
</div>

