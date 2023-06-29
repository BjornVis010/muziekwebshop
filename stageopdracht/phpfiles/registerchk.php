<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>check registreren</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
    <?php

    function test_input($datatest)
    {
        $datatest = trim($datatest);
        $datatest = stripslashes($datatest);
        $datatest = htmlspecialchars($datatest);
        return $datatest;
    }

    
    // check of de wachtwoorden overeen komen en daarna hashen
    if(isset($_POST["register"])) {
        if($_POST['wachtwoord1']==$_POST['wachtwoord2']) {
            
        } else {
            header('refresh: 4; url=register.php');
            echo "Wachwoorden komen niet overeen. probeer opnieuw.";
        }
    } else {
        header('refresh: 4; url=register.php');
        echo "U bent hier niet op de juiste manier gekomen.";
    }

    require "dbconnect.php";

    // vraag de gegevens voor toevoegen op
    $voornaam = test_input($_POST['voornaam']);
    $achternaam = test_input($_POST['achternaam']);
    $adres = test_input($_POST['adres']);
    $stad = test_input($_POST['stad']);
    $email = test_input($_POST['email']);
    $ww = test_input($_POST['wachtwoord1']);

    // controleren email in database
    
    try 
    {
        $chkEmail = $db->prepare("SELECT email FROM client WHERE email = :email");
        $chkEmail->bindValue("email",$email);
        $chkEmail->execute();
        if($chkEmail->rowCount()>0) {
            header("refresh:1; url=register.php");
            echo "Er is al een account met dit email gevonden.";
        }
    } catch(PDOException $e) {
        $sMsg = '<p>
        Regelnummer: '.$e->getLine().'<br />
        Bestand: '.$e->getFile(). '<br />
        Foutmelding: '.$e->getMessage().'
        </p>';

        trigger_error($sMsg);

        die("Fout bij verbinding met database: ".$e->getMessage());
    }
    ?>

    <h2>controleer uw gegevens.</h2>
    <p>druk op de knop &quot;Bevestig&quot; als u akkoord bent.</p>
    <form class="registercheckform" action="registerquery.php" method="POST">
        <input type="text" name="voornaam" value="<?php echo $voornaam ; ?>" readonly>
        <input type="text" name="achternaam" value="<?php echo $achternaam ; ?>" readonly>
        <input type="text" name="adres" value="<?php echo $adres ; ?>" readonly>
        <input type="text" name="stad" value="<?php echo $stad ; ?>" readonly>
        <input type="email" name="email" value="<?php echo $email ; ?>" readonly>
        <input type="password" name="wachtwoord" value="<?php echo $ww ; ?>" readonly>
        <button type="submit" name="cnfrm-register">Bevestig</button>
        <button type="submit" name="reset-register">Annuleren</button>
    </form>

    <footer>
        <h4>© gemaakt door Björn Vis in opdracht van Jorr-IT Solutions</h4>
    </footer>
</body>
</html>