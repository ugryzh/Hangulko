<footer class="footer">
  © <?= date('Y') ?> Hangul Learn
</footer>

<!-- AUTH POPUP -->
<div id="authOverlay" class="auth-overlay">
  <div class="auth-modal">

    <h3 id="authTitle">Logowanie</h3>

    <form id="authForm" autocomplete="off">
      <input
        type="text"
        name="username"
        placeholder="Nazwa użytkownika"
        required
      >

      <input
        type="password"
        name="password"
        placeholder="Hasło"
        required
      >

      <button type="submit" id="authSubmit">
        Zaloguj
      </button>
    </form>

    <div id="authSwitch" class="auth-switch">
      Nie masz konta?
      <a href="#" id="authSwitchLink">Zarejestruj się</a>
    </div>

  </div>
</div>

<!-- JS MUSI BYĆ NA SAMYM KOŃCU -->
<script src="/assets/js/auth.js"></script>
