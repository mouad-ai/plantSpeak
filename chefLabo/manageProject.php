<?php
    $lien = mysqli_connect('localhost', 'root', '', 'pfe');
 
 if(isset($_POST['supprimer'])){
      $sql = "DELETE FROM project where  ChefID = '".$_POST['idC']."' and
         RespnsableID = '".$_POST['idR']."' and
        Date = '".$_POST['date']."'";
      mysqli_query($lien, $sql) or die(mysqli_error($lien));
}
if(isset( $_POST['ajouter'])  && isset($_POST['emailC']) && isset($_POST['emailR']) ){
   $id = 'select * from personne where Email="'.$_POST['emailR'].'"';
    $resultat  = mysqli_query($lien , $id);
    $idR = mysqli_fetch_array($resultat);
   $id = 'select * from personne where Email="'.$_POST['emailC'].'"';
    $resultat  = mysqli_query($lien , $id);
    $idC = mysqli_fetch_array($resultat);
    $date = date('Y-m-d H:i:s');
     $sql = "INSERT INTO project(ChefID,RespnsableID,Titre,Date) VALUES('".$idC['PersonneID']."','" . $idR['PersonneID'] . "','" . $_POST['titre'] . "','" . $date. "')";

       

      mysqli_query($lien, $sql) or die(mysqli_error($lien));

   }