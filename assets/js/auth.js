(function () {

  let mode = 'login';

  const overlay = document.getElementById('authOverlay');
  const title   = document.getElementById('authTitle');
  const form    = document.getElementById('authForm');
  const submit  = document.getElementById('authSubmit');
  const switchBox = document.getElementById('authSwitch');

  window.openAuth = function (type = 'login') {
    mode = type;
    overlay.classList.add('active');

    if (mode === 'login') {
      title.textContent = 'Logowanie';
      submit.textContent = 'Zaloguj';
      switchBox.innerHTML =
        'Nie masz konta? <a href="#">Zarejestruj się</a>';
    } else {
      title.textContent = 'Rejestracja';
      submit.textContent = 'Utwórz konto';
      switchBox.innerHTML =
        'Masz konto? <a href="#">Zaloguj się</a>';
    }
  };

  overlay.addEventListener('click', e => {
    if (e.target === overlay) {
      overlay.classList.remove('active');
    }
  });

  switchBox.addEventListener('click', e => {
    if (e.target.tagName === 'A') {
      e.preventDefault();
      openAuth(mode === 'login' ? 'register' : 'login');
    }
  });

  form.addEventListener('submit', e => {
    e.preventDefault();

    fetch('/api/' + mode + '.php', {
      method: 'POST',
      body: new FormData(form)
    })
    .then(r => r.json())
    .then(data => {
      if (data.success) {
        location.reload();
      } else {
        alert(data.error || 'Wystąpił błąd');
      }
    })
    .catch(() => alert('Błąd połączenia z serwerem'));
  });

})();
