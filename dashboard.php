<?php
require 'api/auth.php';
if(!isLogged()) die('Brak dostępu');
?>

<h1>Witaj <?= htmlspecialchars($_SESSION['username']) ?></h1>
<a href="game.php">Graj</a> |
<a href="premium.php">Premium</a> |
<a href="logout.php">Wyloguj</a>
