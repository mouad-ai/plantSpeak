<?php
    $lien = mysqli_connect('localhost', 'root', '', 'pfe');

  if (isset($_POST['supprimer'])) {
      $idP = $_POST['idP'];
      $idB = $_POST['idB'];
      $date = $_POST['date'];
   $sql = 'delete from observation
      where  PersonneID = "'. $idB.'"
         and PlanteID = "'. $idP.'" and Date="'.$date.'" ';
   mysqli_query($lien, $sql) or die(mysqli_error($lien));
}

?>