<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>alle klanten</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="../index.php">home</a></li>
            <li><a href="klantgegevens.php">klanten</a></li>
            <li><a href="product.php">producten</a></li>
            <li><a href="uitlog.php">log uit</a></li>
        </ul>
    </nav>
   <?php 
   include "dbconnect.php";
   ?>

    <h2>Zoek voor klanten of laat het veld leeg om alle klanten te bekijken.</h2>
    <form method="POST" action="qry-klantgegevens.php">
        <input type="search" name="searchClient" id="searchClient" placeholder="search">
        <button type="submit">zoek</button>
    </form>

    <footer>
        <h4>© gemaakt door Björn Vis in opdracht van Jorr-IT Solutions</h4>
    </footer>
</body>
</html>