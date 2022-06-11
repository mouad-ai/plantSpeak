<?php
    $lien = mysqli_connect('localhost', 'root', '', 'pfe');
 if(isset($_POST['modifier'])){
      $sql = "UPDATE personne
         set Nom = '".$_POST['nom']."',
         Prenom = '".$_POST['prenom']."',
         Email = '".$_POST['email']."',
         MotDePasse = '".$_POST['mdp']."',
         img = '".$_POST['img_url']."'
         where PersonneID = ".$_POST['idB']."
      ";
      mysqli_query($lien, $sql) or die(mysqli_error($lien));
   }
 if(isset($_POST['supprimer']) && isset($_POST['idB'])){
      $sql = "DELETE FROM botaniste where BotanisteID=". $_POST['idB'];
      $sql1 = "DELETE FROM personne where PersonneID=". $_POST['idB'];
      mysqli_query($lien, $sql) or die(mysqli_error($lien));
      mysqli_query($lien, $sql1) or die(mysqli_error($lien));
}
if(isset( $_POST['ajouter'])  && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['mdp']) && isset($_POST['img_url'])){
    $filename = $_FILES["img_url"]["name"];
    $tempname = $_FILES["img_url"]["tmp_name"];
      $sql = "INSERT INTO personne(Nom,Prenom,Email,MotDePasse,img) VALUES('".$_POST['nom']."','" . $_POST['prenom'] . "','" . $_POST['email'] . "','" . $_POST['mdp'] . "','" . $filename. "')";
             $folder = "../images/".$filename;

      mysqli_query($lien, $sql) or die(mysqli_error($lien));
       $last_id = mysqli_insert_id($lien);
      $sql1= 'insert into botaniste (BotanisteID) VALUES ('.$last_id.')';
      mysqli_query($lien, $sql1) or die(mysqli_error($lien));
       if (move_uploaded_file($tempname, $folder))  {
            $msg = "Image uploaded successfully";
        }else{
            $msg = "Failed to upload image";
      }
   }