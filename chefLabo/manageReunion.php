<?php
    $lien = mysqli_connect('localhost', 'root', '', 'pfe');
 if(isset($_POST['modifier'])){

     if ($_POST['physique']==1) {
 $sql = "UPDATE reunion
         set Titre = '".$_POST['titre']."',
         Virtuelle = NULL,
         lien = NULL,
         Physique = '".$_POST['physique']."',
         lieu = '".$_POST['lieu']."'
         where ChefID = '".$_POST['idC']."' and
         RespnsableID = '".$_POST['idR']."' and
        Date = '".$_POST['date']."'
      ";
        }else{
 $sql = "UPDATE reunion
         set Titre = '".$_POST['titre']."',
         Virtuelle = '".$_POST['virtuelle']."',
         lien = '".$_POST['lien']."',
         Physique = NULL,
         lieu=NULL
         where ChefID = '".$_POST['idC']."' and
         RespnsableID = '".$_POST['idR']."' and
        Date = '".$_POST['date']."'
      ";
        }
     
      mysqli_query($lien, $sql) or die(mysqli_error($lien));
   }
 if(isset($_POST['supprimer'])){
      $sql = "DELETE FROM reunion where  ChefID = '".$_POST['idC']."' and
         RespnsableID = '".$_POST['idR']."' and
        Date = '".$_POST['date']."'";
      mysqli_query($lien, $sql) or die(mysqli_error($lien));
}
if(isset( $_POST['ajouter'])  && isset($_POST['emailC']) && isset($_POST['emailR']) && isset($_POST['date'])){
         $id = 'select * from personne where Email="'.$_POST['emailR'].'"';
    $resultat  = mysqli_query($lien , $id);
    $idR = mysqli_fetch_array($resultat);
   $id = 'select * from personne where Email="'.$_POST['emailC'].'"';
    $resultat  = mysqli_query($lien , $id);
    $idC = mysqli_fetch_array($resultat);

        if ($_POST['physique']==1) {
                  $sql = "INSERT INTO reunion(ChefID,RespnsableID,Titre,Virtuelle,Physique,lien,lieu,Date) VALUES('".$idC['PersonneID']."','" . $idR['PersonneID'] . "','" . $_POST['titre'] . "',NULL," . $_POST['physique'] . ",NULL,'" . $_POST['lieu'] . "','" . $_POST['date'] . "')";

        }else{
                  $sql = "INSERT INTO reunion(ChefID,RespnsableID,Titre,Virtuelle,Physique,lien,lieu,Date) VALUES('".$idC['PersonneID']."','" . $idR['PersonneID'] . "','" . $_POST['titre'] . "'," . $_POST['virtuelle'] . ",NULL,'" . $_POST['lien'] . "',NULL,'" . $_POST['date'] . "')";

        }

      mysqli_query($lien, $sql) or die(mysqli_error($lien));

   }