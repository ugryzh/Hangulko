<footer class="footer">
  © <?= date('Y') ?> Hangul Learn
</footer>

<div id="authOverlay" class="auth-overlay">
  <div class="auth-modal">

    <h3 id="authTitle">Logowanie</h3>

    <form id="authForm">
      <input name="username" placeholder="Nazwa użytkownika" required>
      <input type="password" name="password" placeholder="Hasło" required>
      <button id="authSubmit">Zaloguj</button>
    </form>

    <div id="authSwitch" class="auth-switch"></div>

  </div>
</div>

<script src="/assets/js/auth.js"></script>
