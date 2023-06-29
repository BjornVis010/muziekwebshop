<?php

    if (isset($_POST["reset-register"])) {
        echo "<h2>U wilt niet verdergaan.</h2>";
        header('refresh: 3; url=register.php');
        exit();
    }

    if (! isset($_POST["cnfrm-register"])) {
        echo "<h2>U bent niet op de juiste manier hier gekomen</h2>";
        header('refresh:5; url=register.php');
        exit();
    }

    // verbinding met database
    require "dbconnect.php";

    // vraag de gegevens op voor toevoegen
    $voornaam = $_POST["voornaam"];
    $achternaam = $_POST["achternaam"];
    $email = $_POST["email"];
    $ww=password_hash($_POST['wachtwoord'], PASSWORD_DEFAULT);
    $adres = $_POST["adres"];
    $stad = $_POST["stad"];

    // voeg toe aan database

    try {
        $rQuery = $db->prepare("INSERT INTO client (fname, lname, email, password, adress, city) VALUES (:voornaam, :achternaam, :email, :ww, :adres, :stad)");
        $rQuery->bindValue(':voornaam', $voornaam);
        $rQuery->bindValue(':achternaam', $achternaam);
        $rQuery->bindValue(':email', $email);
        $rQuery->bindValue(':ww', $ww);
        $rQuery->bindValue(':adres', $adres);
        $rQuery->bindValue(':stad', $stad);
        $rQuery->execute();
        header('refresh: 2; url=login.php');
        echo "U bent nu aangemeld. U wordt nu naar de inlogpagina gestuurd";
    } catch(PDOException $e) {
        die("Fout bij verbinden met database: ".$e->getMessage());
    }

?>