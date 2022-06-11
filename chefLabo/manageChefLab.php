<?php
    $lien = mysqli_connect('localhost', 'root', '', 'pfe');
 if(isset($_POST['modifier'])){
      $sql = "UPDATE personne
         set Nom = '".$_POST['nom']."',
         Prenom = '".$_POST['prenom']."',
         Email = '".$_POST['email']."',
         MotDePasse = '".$_POST['mdp']."',
         img = '".$_POST['img_url']."'
         where PersonneID = ".$_POST['idR']."
      ";
      mysqli_query($lien, $sql) or die(mysqli_error($lien));
   }
 if(isset($_POST['supprimer']) && isset($_POST['idR'])){
      $sql = "DELETE FROM responsable where ResponsableID=". $_POST['idR'];
      $sql1 = "DELETE FROM personne where PersonneID=". $_POST['idR'];
      mysqli_query($lien, $sql) or die(mysqli_error($lien));
      mysqli_query($lien, $sql1) or die(mysqli_error($lien));
}
if(isset( $_POST['ajouter'])  && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['mdp']) && isset($_POST['img_url'])){
      $sql = "INSERT INTO personne(Nom,Prenom,Email,MotDePasse,img) VALUES('".$_POST['nom']."','" . $_POST['prenom'] . "','" . $_POST['email'] . "','" . $_POST['mdp'] . "','" . $_POST['img_url'] . "')";
      mysqli_query($lien, $sql) or die(mysqli_error($lien));
       $last_id = mysqli_insert_id($lien);
      $sql1= 'insert into responsable (ResponsableID) VALUES ('.$last_id.')';
      mysqli_query($lien, $sql1) or die(mysqli_error($lien));
   }