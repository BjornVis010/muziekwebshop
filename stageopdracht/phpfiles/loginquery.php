<?php
    require 'dbconnect.php';
		if(isset($_POST['submit'])) {

            try {
                
                $sQuery = "SELECT * FROM client WHERE email = :email";
                $oStmt = $db->prepare($sQuery);
                $oStmt->bindValue(':email',$_POST['email']);
                $oStmt->execute();
                if($oStmt->rowCount()==1) {
                    
                    $rij = $oStmt->fetch(PDO::FETCH_ASSOC);
                    if(password_verify($_POST['password'],$rij['password'])) 
                    {
                        $_SESSION['email']=$rij['email'];
                        $_SESSION['admin']=$rij['admin'];
                        if($rij['admin']==null){
                            $_SESSION['klogin']= true;
                            header('Refresh: 2; url=mijnpagina.php');
                            echo "Login succesvol";
                        } else {
                            $_SESSION['blogin']= true;
                            header('Refresh: 2; url=beheerderpagina.php');
                            echo "Login succesvol";
                        }
                    }else{
                        echo "<div class='panel-heading'>Helaas, login niet succesvol</div>
                        <div class='panel-body'>Deze combinatie van email en wachtwoord is niet juist</div>";
                    }
                }
            } catch(PDOException $e) {
                die("Fout bij het verbinden met de database: ".$e->getMessage());
            }
        }
?>
<div class="container">
<div class="panel panel-primary">


</div>
</div>