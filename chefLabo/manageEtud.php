<?php
    $lien = mysqli_connect('localhost', 'root', '', 'pfe');
 if(isset($_POST['modifier'])){
      $sql = "UPDATE botaniste
         set Niveau = '".$_POST['niv']."',
         Universite = '".$_POST['univer']."'
         where BotanisteID = ".$_POST['idB']."
      ";
      mysqli_query($lien, $sql) or die(mysqli_error($lien));
   }
 if(isset($_POST['supprimer']) && isset($_POST['idB'])){
      $sql = "update botaniste set Niveau =NULL , Universite = NULL , etudiant = NULL , stagaire=NULL,Duree=NULL  where BotanisteID = ".$_POST['idB']."";
      mysqli_query($lien, $sql) or die(mysqli_error($lien));
}
if(isset( $_POST['ajouter'])  && isset($_POST['email']) && isset($_POST['niv']) && isset($_POST['univer'])){
    $id = 'select * from personne where Email="'.$_POST['email'].'"';
    $resultat  = mysqli_query($lien , $id);
    $id = mysqli_fetch_array($resultat);
      $sql = "update  botaniste set Niveau ='".$_POST['niv']."' , Universite = '".$_POST['univer']."' , etudiant = 1 , stagaire=NULL,Duree=NULL  where BotanisteID = ".$id['PersonneID']."";
      mysqli_query($lien, $sql) or die(mysqli_error($lien));
   }