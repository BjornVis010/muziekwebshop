<!DOCTYPE html>
<html lang="nl"> 
<head>
	 <meta charset="UTF-8">
	 <title>log in</title>
	 <link rel="stylesheet" href="../style.css">  
</head>

<body>
<nav>
     <ul>
		<li><a href="../index.php">home</a></li>
        <li><a href="login.php">log in</a></li>
        <li><a href="register.php">registreer</a></li>
    </ul>
</nav>
	<header>
		<h1>Welkom bij de enige echte muziek webshop</h1>
		<!-- start de sessie -->
		<?php
			session_start(); 
		?>
	</header>
 
	<!-- op de home pagina wat enthousiaste tekst over het bedrijf en de producten -->
 	<main>
		<?php
		require 'loginquery.php';
		?>
		<form class="loginform" action="loginquery.php" method="POST">
			<input type="email" name="email" id="email" placeholder="email" required>
			<input type="password" name="password" id="password" placeholder="password" required>
			<button type="submit" name="submit" id="submit">submit</button>
		</form>
		<h3>Heeft u nog geen account? </h3><a href="register.php">Registreer hier!</a>
	</main>
	
	<footer>
        <h4>© gemaakt door Björn Vis in opdracht van Jorr-IT Solutions</h4>
    </footer>
</body>
</html>