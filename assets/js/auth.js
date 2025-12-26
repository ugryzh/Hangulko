document.addEventListener('DOMContentLoaded', () => {

  const overlay = document.getElementById('authOverlay');
  const title = document.getElementById('authTitle');
  const form = document.getElementById('authForm');
  const submit = document.getElementById('authSubmit');
  const switcher = document.getElementById('authSwitch');

  let mode = 'login';

  window.openAuth = function(type = 'login') {
    mode = type;
    overlay.classList.add('active');

    if (mode === 'login') {
      title.textContent = 'Zaloguj się';
      submit.textContent = 'Zaloguj';
      switcher.innerHTML = 'Nie masz konta? <a href="#">Zarejestruj się</a>';
    } else {
      title.textContent = 'Rejestracja';
      submit.textContent = 'Utwórz konto';
      switcher.innerHTML = 'Masz konto? <a href="#">Zaloguj się</a>';
    }
  };

  overlay.addEventListener('click', e => {
    if (e.target === overlay) overlay.classList.remove('active');
  });

  switcher.addEventListener('click', e => {
    e.preventDefault();
    openAuth(mode === 'login' ? 'register' : 'login');
  });

  form.addEventListener('submit', e => {
    e.preventDefault();

    fetch(`/api/${mode}.php`, {
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
      });
  });

});
