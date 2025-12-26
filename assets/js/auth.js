(function () {

  let mode = 'login';

  const overlay = document.getElementById('authOverlay');
  const title   = document.getElementById('authTitle');
  const form    = document.getElementById('authForm');
  const submit  = document.getElementById('authSubmit');
  const switchBox  = document.getElementById('authSwitch');
  const switchLink = document.getElementById('authSwitchLink');

  // ⬅️ NAJWAŻNIEJSZE: GLOBALNA FUNKCJA
  window.openAuth = function (type = 'login') {
    mode = type;
    overlay.classList.add('active');

    if (mode === 'login') {
      title.textContent = 'Logowanie';
      submit.textContent = 'Zaloguj';
      switchBox.innerHTML = 'Nie masz konta? <a href="#" id="authSwitchLink">Zarejestruj się</a>';
    } else {
      title.textContent = 'Rejestracja';
      submit.textContent = 'Utwórz konto';
      switchBox.innerHTML = 'Masz konto? <a href="#" id="authSwitchLink">Zaloguj się</a>';
    }
  };

  // zamykanie klikając tło
  overlay.addEventListener('click', e => {
    if (e.target === overlay) {
      overlay.classList.remove('active');
    }
  });

  // przełączanie login/register (delegacja)
  switchBox.addEventListener('click', e => {
    if (e.target.tagName === 'A') {
      e.preventDefault();
      openAuth(mode === 'login' ? 'register' : 'login');
    }
  });

  // SUBMIT
  form.addEventListener('submit', e => {
    e.preventDefault();

    fetch('/api/' + mode + '.php', {
      method: 'POST',
      body: new FormData(form)
    })
    .then(r => r.text())
    .then(res => {
      if (res.trim() === 'OK') {
        location.reload();
      } else {
        alert(res);
      }
    })
    .catch(() => alert('Błąd połączenia z serwerem'));
  });

})();
