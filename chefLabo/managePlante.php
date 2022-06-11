<?php
    $lien = mysqli_connect('localhost', 'root', '', 'pfe');
 if(isset($_POST['modifier'])){
      $sql = "UPDATE plante
         set Nom = '".$_POST['nom']."',
         Description = '".$_POST['desc']."',
         Photo = '".$_POST['img_url']."'
         where PlanteID = ".$_POST['idP']."
      ";
      mysqli_query($lien, $sql) or die(mysqli_error($lien));
   }
 if(isset($_POST['supprimer']) && isset($_POST['idP'])){
      $sql = "DELETE FROM observation where PlanteID=". $_POST['idP'];
      $sql1 = "DELETE FROM plante where PlanteID=". $_POST['idP'];
      mysqli_query($lien, $sql) or die(mysqli_error($lien));
      mysqli_query($lien, $sql1) or die(mysqli_error($lien));
}
if(isset( $_POST['ajouter'])  && isset($_POST['nom']) && isset($_POST['desc']) ){
      $sql = "INSERT INTO plante(Nom,Description,Photo) VALUES('".$_POST['nom']."','" . $_POST['desc'] . "','" . $_POST['img_url'] . "')";
      mysqli_query($lien, $sql) or die(mysqli_error($lien));
       $last_id = mysqli_insert_id($lien);
   }