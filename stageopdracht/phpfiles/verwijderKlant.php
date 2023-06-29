<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>verwijder klant</title>
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
#1 verbinding met database
require "dbconnect.php";
$selclient = $db->prepare("SELECT id, fname FROM client WHERE fname LIKE :fname");
$delClientID = filter_input(INPUT_POST, "delClient", FILTER_SANITIZE_STRING);

#2 een query definiëren
try {
    $delQuery = $db->prepare("DELETE FROM client WHERE fname = :fname");
    $delQuery->bindValue(':fname', $delClientID);
    #3 query uitvoeren
    $delQuery->execute();
}
catch(PDOException $e) {
    die("database connection error: ".$e->getMessage());
}

echo "de klant is verwijderd.";
?>

    <a href="Beheerderpagina.php"><button>ga terug naar de site</button></a>
</body>
</html>