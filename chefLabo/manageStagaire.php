<?php
    $lien = mysqli_connect('localhost', 'root', '', 'pfe');
 if(isset($_POST['modifier'])){
      $sql = "UPDATE botaniste
         set Duree = '".$_POST['duree']."'
         where BotanisteID = ".$_POST['idB']."
      ";
      mysqli_query($lien, $sql) or die(mysqli_error($lien));
   }
 if(isset($_POST['supprimer']) && isset($_POST['idB'])){
      $sql = "update botaniste set Niveau =NULL , Universite = NULL , etudiant = NULL , stagaire=NULL,Duree=NULL  where BotanisteID = ".$_POST['idB']."";
      mysqli_query($lien, $sql) or die(mysqli_error($lien));
}
if(isset( $_POST['ajouter'])  && isset($_POST['email']) && isset($_POST['duree'])){
   $id = 'select * from personne where Email="'.$_POST['email'].'"';
    $resultat  = mysqli_query($lien , $id);
    $id = mysqli_fetch_array($resultat);
      $sql = "update  botaniste set Niveau =NULL , Universite = NULL, etudiant = NULL , stagaire=1 , Duree='".$_POST['duree']."'  where BotanisteID = ".$id['PersonneID']."";
      mysqli_query($lien, $sql) or die(mysqli_error($lien));
   }