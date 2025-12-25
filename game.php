<?php
require 'api/auth.php';
if(!isLogged()) die('Zaloguj się');

$isPremium = isPremium();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title>Hangul Learn – Gra</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="game-container">
  <h2>🎮 Nauka Hangula</h2>

  <select id="mode">
    <option value="con">Spółgłoski</option>
    <option value="vow">Samogłoski</option>
    <option value="syl">Sylaby</option>
  </select>

  <?php if(!$isPremium): ?>
    <p class="demo-info">Wersja demo – ograniczona liczba znaków</p>
  <?php endif; ?>

  <div id="hangul" class="hangul">가</div>

  <input id="answer" placeholder="Wpisz po polsku">

  <button onclick="checkAnswer()">Sprawdź</button>
  <button onclick="playAudio()">🔊 Wymowa</button>

  <?php if(!$isPremium): ?>
    <div class="adsense">REKLAMA ADSENSE</div>
  <?php endif; ?>

  <p id="result"></p>
</div>

<script>
const PREMIUM = <?= $isPremium ? 'true' : 'false' ?>;
</script>
<script src="js/game.js"></script>

</body>
</html>
