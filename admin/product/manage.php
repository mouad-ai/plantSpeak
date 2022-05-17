<?php
    $lien = mysqli_connect('localhost', 'root', '', 'shop');
 if(isset($_POST['modifier'])){
      $sql = "UPDATE produit
         set Prix = ".$_POST['Prix'].",
         Designation = '".$_POST['Designation']."',
         categorie = '".$_POST['categorie']."',
         prixacquisition = '".$_POST['prixacquisition']."',
         img_url = '".$_POST['img_url']."'
         where REF = ".$_POST['REF']."
      ";
      mysqli_query($lien, $sql) or die(mysqli_error($lien));
   }
 if(isset($_POST['supprimer']) && isset($_POST['REF'])){
      $sql = "DELETE FROM produit where REF=" . $_POST['REF'];
      mysqli_query($lien, $sql) or die(mysqli_error($lien));
}
if(isset( $_POST['ajouter']) && isset($_POST['REF']) && isset($_POST['Prix']) && isset($_POST['Designation']) && isset($_POST['categorie']) && isset($_POST['prixacquisition']) && isset($_POST['img_url'])){
      $sql = "INSERT INTO produit(REF,Prix,Designation,categorie,prixacquisition,img_url) VALUES(".$_POST['REF'].",'" . $_POST['Prix'] . "','" . $_POST['Designation'] . "','" . $_POST['categorie'] . "','" . $_POST['prixacquisition'] . "','" . $_POST['img_url'] . "')";
      echo $sql;
      mysqli_query($lien, $sql) or die(mysqli_error($lien));
   }