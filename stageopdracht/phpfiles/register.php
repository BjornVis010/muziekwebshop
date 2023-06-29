<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registreren</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
		<h1>Welkom bij de enige echte Muziek webshop</h1>
		<!-- start de sessie. -->
		<?php
			session_start(); 
		?>
	</header>

    <?php
        require "dbconnect.php";
    ?>
    <form class="registerform" action="registerchk.php" method="POST">
        <hr style="border-top:1px groovy #000;">
            <br><input type="text" name="voornaam" id="voornaam" placeholder="Voornaam" required>
            <br><input type="text" name="achternaam" id="achternaam" placeholder="achternaam" required>
            <br><input type="text" name="adres" id="adres" placeholder="adres" required>
            <br><input type="text" name="stad" id="stad" placeholder="stad" required>
            <br><input type="email" name="email" id="email" placeholder="email" required autocomplete="false">
            <br><input type="password" name="wachtwoord1" id="wachtwoord1" placeholder="vul uw wachtwoord in" required autocomplete="off">
            <br><input type="password" name="wachtwoord2" id="wachtwoord2" placeholder="vul wachtwoord opnieuw in" required autocomplete="off">
            <br><button type="submit" name="register" id="register" method="register">register</button>
    </form>

    <footer>
        <h4>© gemaakt door Björn Vis in opdracht van Jorr-IT Solutions</h4>
    </footer>
</body>
</html>