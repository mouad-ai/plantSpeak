<?php
    session_start();

if (isset($_POST['email']) and isset($_POST['password'])) {
        $psd=$_POST['password'];
        $email = $_POST['email'];
        $lien = mysqli_connect('localhost','root','','pfe');
        $sql = 'select * from personne where Email="'.$email.'" and MotDePasse="'.$psd.'"';
        $result = mysqli_query($lien , $sql);
        if(mysqli_num_rows($result) == 0){
            
        }
        
        var_dump($result);
        $linge = mysqli_fetch_array($result);
        $_SESSION["nom"]= $linge['Nom'];
            $_SESSION["prenom"]=$linge['Prenom'];
            $_SESSION['img']= $linge['img'];
            $_SESSION['id'] = $linge['PersonneID'];
        $id = $linge['PersonneID'];
        echo $id;
        $sql = 'select * from botaniste where BotanisteID ='.$id.'';
        $result2 = mysqli_query($lien,$sql);
        if (mysqli_num_rows($result2)) {
            $_SESSION["botaniste"] = "true";
            
            header('location: Botaniste/');
        }
        $sql = 'select * from chefequipe where ChefID = '.$id.'';
        $result2 = mysqli_query($lien , $sql);
        if (mysqli_num_rows($result2)) {
            $_SESSION["chef"] = "true";
            
            header('location: chefEquipe/');
        }
        $sql = 'select * from responsable where ResponsableID = '.$id.'';
        $result2 = mysqli_query($lien , $sql);
        if (mysqli_num_rows($result2)) {
            $_SESSION["responsable"] = "true";
            
            header('location: chefLabo/');
        }
        
    }
?>