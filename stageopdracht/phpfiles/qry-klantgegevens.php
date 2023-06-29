<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alle klanten</title>
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
        #0 Testen of afkomstig van het juiste scherm mbv submt button
        if (! isset($_POST["searchClient"])) {
            echo "<h2>U moet eerst het formulier invoeren</h2>";
            header('refresh:5, url=klantgegevens.php');
            die();
        }

        #1 verbinding met database
        require "dbconnect.php";
        
        #1A vul de variabele namefilm met beginletter(s) en wildcard
        $searchClient = filter_input(INPUT_POST, "searchClient", FILTER_SANITIZE_STRING)."%";

    #2 een query definiëren
    try {
        $clientQuery = $db->prepare("SELECT id, fname, lname, email, adress, city FROM client
                                WHERE lname LIKE :lname");
        $clientQuery->bindValue(':lname', $searchClient);
    }
    catch(PDOException $e) {
        die("database connection error: ".$e->getMessage());
    }
    #3 query uitvoeren

    $clientQuery->execute();

        #4 check of er een resultaat is
        if($clientQuery->RowCount()>0) 
        {
            $result=$clientQuery->fetchAll(PDO::FETCH_ASSOC);

        #5 resultaat op scherm tonen
    ?>
        <table>
            <thead>
                <th>id</th>
                <th>voornaam</th>
                <th>achternaam</th>
                <th>email</th>
                <th>adres</th>
                <th>stad</th>
                <th>wijzig</th>
                <th>verwijder</th>
            </thead>
            <tbody>
                <?php
                foreach($result as $rij) {
                    echo "<tr><td>" . $rij["id"] ."</td>";
                    echo "<td>" . $rij["fname"] ."</td>";
                    echo "<td>" . $rij["lname"] ."</td>";
                    echo "<td>" . $rij["email"] ."</td>";
                    echo "<td>" . $rij["adress"] ."</td>";
                    echo "<td>" . $rij["city"] ."</td>";
                    echo "<td>" . "<button><a href='wijzigKlant.php'>wijzig</a></button>" ."</td></tr>";
                    echo "<td>" . "<button><a href='verwijderKlant.php'>verwijder</a></button>" ."</td>";
                }
                ?>
            </tbody>
        </table>
    <?php
    }
    else {
        #bij geen resultaat een melding op het scherm
        echo "<h2>Sorry, er zijn geen resultaten gevonden.</h2>";
    }
    ?>

<footer>
        <h4>© gemaakt door Björn Vis in opdracht van Jorr-IT Solutions</h4>
    </footer>
</body>
</html>