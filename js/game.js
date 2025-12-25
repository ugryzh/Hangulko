const DATA = {
  con: [
    {k:'ㄱ', p:'g'},
    {k:'ㄴ', p:'n'},
    {k:'ㄷ', p:'d'}
  ],
  vow: [
    {k:'ㅏ', p:'a'},
    {k:'ㅓ', p:'eo'}
  ],
  syl: [
    {k:'가', p:'ga'},
    {k:'나', p:'na'}
  ]
};

let current = null;

function getPool(mode){
  let pool = DATA[mode];
  if(!PREMIUM) {
    return pool.slice(0,1); // DEMO
  }
  return pool;
}

function next(){
  const mode = document.getElementById('mode').value;
  const pool = getPool(mode);
  current = pool[Math.floor(Math.random()*pool.length)];
  document.getElementById('hangul').innerText = current.k;
  document.getElementById('answer').value = '';
}

function checkAnswer(){
  const val = document.getElementById('answer').value.trim().toLowerCase();
  const ok = val === current.p;

  document.getElementById('result').innerText =
    ok ? '✅ Dobrze!' : '❌ Źle: ' + current.p;

  fetch('api/progress.php', {
    method:'POST',
    headers:{'Content-Type':'application/json'},
    body: JSON.stringify({
      symbol: current.k,
      correct: ok ? 1 : 0,
      wrong: ok ? 0 : 1
    })
  });

  setTimeout(next, 800);
}

function playAudio(){
  const audio = new Audio('assets/audio/' + current.k + '.mp3');
  audio.play();
}

next();
