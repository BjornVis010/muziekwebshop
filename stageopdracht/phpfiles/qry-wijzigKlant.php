<?php
    require 'dbconnect.php';
		if(isset($_POST['submit'])) {
            try {
                
                $sQuery = "SELECT * FROM client WHERE email = :oldEmail";
                $oStmt = $db->prepare($sQuery);
                $oStmt->bindValue(':oldEmail',$_POST['oldEmail']);
                $oStmt->execute();
                if($oStmt->rowCount()==1) {
                    
                    $rij = $oStmt->fetch(PDO::FETCH_ASSOC);
                }
            } catch(PDOException $e) {
            die("Fout bij het verbinden met de database: ".$e->getMessage());
        }
        } 
try {
    $selQuery = $db->prepare("UPDATE client SET email=:newEmail WHERE email LIKE :oldEmail");
    $selQuery->bindValue(':newEmail', $_POST['newEmail']);
    $selQuery->bindValue(':oldEmail',$_POST['oldEmail']);
    #3 query uitvoeren
    try {
    $selQuery->execute();
    echo "de email van de klant is veranderd. <a href='beheerderpagina.php'><button>ga terug naar de site</button></a>";
    } catch(PDOException $e) {
        die("Fout bij het uitvoeren van de taak: ".$e->getMessage());
    }
}
catch(PDOException $e) {
    die("database connection error: ".$e->getMessage());
}
?>