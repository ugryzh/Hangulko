const modal = document.getElementById('authModal');
const title = document.getElementById('authTitle');
const form  = document.getElementById('authForm');
const btn   = document.getElementById('authSubmit');
const link  = document.getElementById('switchAuth');

let mode = 'login';

function openAuth(type = 'login') {
  mode = type;
  modal.classList.add('active');

  if (mode === 'login') {
    title.textContent = 'Logowanie';
    btn.textContent = 'Zaloguj się';
    link.textContent = 'Nie masz konta? Zarejestruj się';
  } else {
    title.textContent = 'Rejestracja';
    btn.textContent = 'Zarejestruj się';
    link.textContent = 'Masz konto? Zaloguj się';
  }
}

link.onclick = e => {
  e.preventDefault();
  openAuth(mode === 'login' ? 'register' : 'login');
};

modal.onclick = e => {
  if (e.target === modal) modal.classList.remove('active');
};

form.onsubmit = e => {
  e.preventDefault();

  fetch(`/api/${mode}.php`, {
    method: 'POST',
    body: new FormData(form)
  })
  .then(r => r.text())
  .then(res => {
    if (res === 'OK') {
      location.reload();
    } else {
      alert(res);
    }
  });
};
