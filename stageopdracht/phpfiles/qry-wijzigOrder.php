<?php
require 'dbconnect.php';
    try {
                
        $sQuery = "SELECT delivered FROM orders WHERE delivered = :deliveredOLD";
        $oStmt = $db->prepare($sQuery);
        $oStmt->bindValue(':deliveredOLD',$_POST['deliveredOLD']);
        $oStmt->execute();
        if($oStmt->rowCount()==1) {
                    
            $rij = $oStmt->fetch(PDO::FETCH_ASSOC);
        }
    } catch(PDOException $e) {
        die("Fout bij het verbinden met de database: ".$e->getMessage());
    }
try {
    $selQuery = $db->prepare("UPDATE orders SET delivered=:deliveredNEW WHERE delivered LIKE :deliveredOLD");
    $selQuery->bindValue(':deliveredNEW', $_POST['deliveredNEW']);
    $selQuery->bindValue(':deliveredOLD',$_POST['deliveredOLD']);
    #3 query uitvoeren
    try {
    $selQuery->execute();
    echo "de order is veranderd. <a href='beheerderpagina.php'><button>ga terug naar de site</button></a>";
    } catch(PDOException $e) {
        die("Fout bij het uitvoeren van de taak: ".$e->getMessage());
    }
}
catch(PDOException $e) {
    die("database connection error: ".$e->getMessage());
}
?>