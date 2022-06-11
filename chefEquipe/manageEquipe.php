<?php
    $lien = mysqli_connect('localhost', 'root', '', 'pfe');

 if(isset($_POST['supprimer']) && isset($_POST['Nom'])){
    $Nom = $_POST['Nom'];
      $sql = 'DELETE FROM equipe where Nom="'.$Nom.'" and BotanisteID='.$_POST['idB'].' and ChefID = '.$_POST['idC'].'';
      mysqli_query($lien, $sql) or die(mysqli_error($lien));
}
if( isset($_POST['ajouter']) ){


      $Nom = $_POST['Nom'];

       $id = 'select * from personne where Email="'.$_POST['emailB'].'"';
    $resultat  = mysqli_query($lien , $id);
    $idB = mysqli_fetch_array($resultat);
   $id = 'select * from personne where Email="'.$_POST['emailC'].'"';
    $resultat  = mysqli_query($lien , $id);
    $idC = mysqli_fetch_array($resultat);
   
      $sql = 'INSERT INTO equipe(Nom,ChefID,BotanisteID) VALUES("'.$Nom.'" , '.$idC['PersonneID'].','.$idB['PersonneID'].')';
      mysqli_query($lien, $sql) or die(mysqli_error($lien));
   }
   if (isset($_POST['modifier'])) {
      $idB = $_POST['idB'];
      $Nom = $_POST['Nom'];
   $sql = 'UPDATE equipe
      set  BotanisteID = "'. $idB.'"
         where Nom = "'. $Nom.'" ';
   mysqli_query($lien, $sql) or die(mysqli_error($lien));
}