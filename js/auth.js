document.addEventListener('DOMContentLoaded', () => {

  const modal  = document.getElementById('authModal');
  const title  = document.getElementById('authTitle');
  const form   = document.getElementById('authForm');
  const btn    = document.getElementById('authSubmit');
  const switchLink = document.getElementById('switchAuth');

  let mode = 'login';

  window.openAuth = function(type = 'login') {
    mode = type;
    modal.classList.add('active');

    if (mode === 'login') {
      title.textContent = 'Logowanie';
      btn.textContent = 'Zaloguj';
      switchLink.textContent = 'Nie masz konta? Rejestracja';
    } else {
      title.textContent = 'Rejestracja';
      btn.textContent = 'Zarejestruj';
      switchLink.textContent = 'Masz konto? Logowanie';
    }
  };

  switchLink.addEventListener('click', e => {
    e.preventDefault();
    openAuth(mode === 'login' ? 'register' : 'login');
  });

  modal.addEventListener('click', e => {
    if (e.target === modal) modal.classList.remove('active');
  });

  form.addEventListener('submit', e => {
    e.preventDefault();

    fetch('/api/' + mode + '.php', {
      method: 'POST',
      body: new FormData(form)
    })
    .then(res => res.text())
    .then(res => {
      if (res.trim() === 'OK') {
        location.reload();
      } else {
        alert(res);
      }
    })
    .catch(err => alert('Błąd połączenia'));
  });

});
