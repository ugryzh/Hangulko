<footer class="footer">
  <div class="container">

    <!-- POLECAJĄ NAS -->
    <div class="recommended-section mb-4">
      <h6 class="text-muted mb-3">Polecają nas:</h6>
      <div class="recommended-logos">
        <span class="rec-logo">EduTech Polska</span>
        <span class="rec-logo">Korea Culture Hub</span>
        <span class="rec-logo">LearnAsia</span>
      </div>
    </div>

    <p class="mb-1">
      © <?= date('Y') ?> <strong>Hangul Learn</strong>
    </p>

    <p class="text-muted mb-0">
      Nauka alfabetu koreańskiego 🇰🇷 – prosto i nowocześnie
    </p>

  </div>
</footer>

<!-- =========================
     POPUP LOGOWANIE / REJESTRACJA
========================= -->
<div id="authModal" class="modal-auth">
  <div class="modal-box auth-card animate">

    <h4 class="text-center mb-3" id="authTitle">
      Logowanie
    </h4>

    <form id="authForm">

      <input
        type="text"
        name="username"
        class="form-control mb-2"
        placeholder="Nazwa użytkownika"
        required
      >

      <input
        type="password"
        name="password"
        class="form-control mb-3"
        placeholder="Hasło"
        required
      >

      <button
        type="submit"
        class="btn btn-primary w-100"
        id="authSubmit"
      >
        Zaloguj się
      </button>

    </form>

    <p class="text-center mt-3 mb-0">
      <a href="#" id="switchAuth">
        Nie masz konta? Zarejestruj się
      </a>
    </p>

  </div>
</div>

<script src="/assets/js/auth.js"></script>
