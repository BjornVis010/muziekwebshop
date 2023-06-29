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
            <li><a href="orders.php">orders</a></li>
            <li><a href="uitlog.php">log uit</a></li>
        </ul>
    </nav>

<?php
        #0 Testen of afkomstig van het juiste scherm mbv submt button
        if (! isset($_POST["searchorders"])) {
            echo "<h2>U moet eerst het formulier invoeren</h2>";
            header('refresh:5, url=klantgegevens.php');
            die();
        }

        #1 verbinding met database
        require "dbconnect.php";
        
        #1A vul de variabele namefilm met beginletter(s) en wildcard
        $searchorder = filter_input(INPUT_POST, "searchorder", FILTER_SANITIZE_STRING)."%";

    #2 een query definiëren
    try {
        $ordersQuery = $db->prepare("SELECT id, order_id, delivered, clientid FROM orders
                                WHERE order_id LIKE :order_id");
        $ordersQuery->bindValue(':order_id', $searchorder);
    }
    catch(PDOException $e) {
        die("database connection error: ".$e->getMessage());
    }
    #3 query uitvoeren

    $ordersQuery->execute();

        #4 check of er een resultaat is
        if($ordersQuery->RowCount()>0) 
        {
            $result=$ordersQuery->fetchAll(PDO::FETCH_ASSOC);

        #5 resultaat op scherm tonen
    ?>
        <table>
            <thead>
                <th>id</th>
                <th>client_id</th>
                <th>delivered</th>
                <th>clientid</th>
                <th>wijzig</th>
            </thead>
            <tbody>
                <?php
                foreach($result as $rij) {
                    echo "<tr><td>" . $rij["id"] ."</td>";
                    echo "<td>" . $rij["order_id"] ."</td>";
                    echo "<td>" . $rij["delivered"] ."</td>";
                    echo "<td>" . $rij['clientid'] ."</td>";
                    echo "<td>" . "<button id='wijzig'><a href='wijzigOrder.php'>wijzig</a></button>" ."</td></tr>";
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