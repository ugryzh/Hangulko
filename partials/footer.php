<footer class="footer mt-5">
  <div class="container text-center">

    <p class="mb-1">
      © <?= date('Y') ?> <strong>Hangul Learn</strong>
    </p>

    <p class="text-muted mb-0">
      Nauka alfabetu koreańskiego 🇰🇷 w nowoczesny sposób
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

<!-- =========================
     JS
========================= -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="/assets/js/auth.js"></script>
