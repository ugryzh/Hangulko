document.addEventListener('DOMContentLoaded', () => {

  const modal = document.getElementById('authModal');
  const box = modal.querySelector('.modal-box');
  const title = document.getElementById('authTitle');
  const form = document.getElementById('authForm');
  const submit = document.getElementById('authSubmit');
  const switchAuth = document.getElementById('switchAuth');

  let mode = 'login';

  window.openAuth = function (type = 'login') {
    mode = type;
    modal.classList.add('active');

    if (mode === 'login') {
      title.textContent = 'Zaloguj się';
      submit.textContent = 'Zaloguj się';
      switchAuth.textContent = 'Nie masz konta? Zarejestruj się';
    } else {
      title.textContent = 'Utwórz konto';
      submit.textContent = 'Zarejestruj się';
      switchAuth.textContent = 'Masz konto? Zaloguj się';
    }

    box.classList.remove('shake');
  };

  switchAuth.addEventListener('click', e => {
    e.preventDefault();
    openAuth(mode === 'login' ? 'register' : 'login');
  });

  modal.addEventListener('click', e => {
    if (e.target === modal) {
      modal.classList.remove('active');
    }
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
          box.classList.add('shake');
          alert(res);
        }
      })
      .catch(() => {
        box.classList.add('shake');
        alert('Błąd połączenia z serwerem');
      });
  });

});
