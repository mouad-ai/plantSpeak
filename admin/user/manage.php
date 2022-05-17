<?php
$lien = mysqli_connect('localhost', 'root', '', 'shop');
if(isset($_POST['ajouter']) && isset($_POST['name']) && isset($_POST['tel']) && isset($_POST['adresse']) && isset($_POST['ville']) && isset($_POST['isAdmin'])){

   $sql = "INSERT INTO client(name,tel,adresse,ville,isAdmin,email,password) VALUES('".$_POST['name']."','" . $_POST['tel'] . "','" . $_POST['adresse'] . "','" . $_POST['ville'] . "','" . $_POST['isAdmin'] . "','" . $_POST['email'] . "','" . $_POST['password'] . "')";
   echo $sql;
   mysqli_query($lien, $sql) or die(mysqli_error($lien));

}
if(isset($_POST['supprimer']) && isset($_POST['id'])){
   $sql = "DELETE FROM client where client.id=" . $_POST['id'];
   mysqli_query($lien, $sql) or die(mysqli_error($lien));
}

if (isset($_POST['modifier'])) {
   $sql = "UPDATE client
      set name = '" . $_POST['name'] . "',
         tel = '" . $_POST['tel'] . "',
         adresse = '" . $_POST['adresse'] . "',
         password = '" . $_POST['password'] . "',
         email = '" . $_POST['email'] . "',
         ville = '" . $_POST['ville'] . "',
         isAdmin = '" . $_POST['isAdmin'] . "'
         where id = " . $_POST['id'] . "
      ";
   mysqli_query($lien, $sql) or die(mysqli_error($lien));
}