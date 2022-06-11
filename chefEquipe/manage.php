<?php
    $lien = mysqli_connect('localhost', 'root', '', 'pfe');

  if (isset($_POST['modifier'])) {
     $id = 'select * from personne where Email="'.$_POST['emailB'].'"';
    $resultat  = mysqli_query($lien , $id);
    $idB = mysqli_fetch_array($resultat);

      $idP = $_POST['idP'];
      
   $sql = 'UPDATE plante
      set  BotanisteID = "'. $idB['PersonneID'].'"
         where PlanteID = "'. $idP.'" ';
   mysqli_query($lien, $sql) or die(mysqli_error($lien));
}

?>