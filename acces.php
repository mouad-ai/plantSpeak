<?php

   $lien = mysqli_connect('localhost', 'root', '', 'shop');
   if(isset($_POST['adresse'])){
      // signup
      $tel = $_POST['phone'];
      $email = $_POST['email'];
      $name = $_POST['name'];
      $pwd = $_POST['password'];
      $ville = $_POST['ville'];
      $addr = $_POST['adresse'];
      session_start();
      $sql = "INSERT INTO client(name,email,password,tel,ville,adresse) VALUES('$name','$email','$pwd','$tel','$ville','$addr')";
      mysqli_query($lien, $sql) or die(mysqli_error($lien));
      $_SESSION['id']  = mysqli_insert_id($lien); 
      $_SESSION['email'] = $_POST['email'];
      $_SESSION['password'] = $_POST['password'];
      $_SESSION['isAdmin'] = '0';
      header('location: shop.php');
   }else{
      // signin
      $sql = "SELECT * FROM client where client.email='" . $_POST['email']."' and client.password='".$_POST['password']."'";
      $res = mysqli_query($lien, $sql) or die(mysqli_error($lien));
      $client = mysqli_fetch_assoc($res);
      if(isset($client)){
         session_start();
         $_SESSION['id'] = $client['id'];
         $_SESSION['email'] = $_POST['email'];
         $_SESSION['password'] = $_POST['password'];
         $_SESSION['isAdmin'] = $client['isAdmin'];

         header('location: shop.php');
         // connect
      }else{
         // incorrect
         header('location: authenticate.php?error=true');
         echo "not set";
      }
   }
   // sessions
   // if(isset($_POST['username']) && isset($_POST['password']) && $_POST['username'] == $username && $_POST['password'] == $pwd){
   //       $_SESSION['username'] = $_POST['username'];
   //       $_SESSION['password'] = $_POST['password'];
   //       header("location: userhome.php");
   // }else{
   //    header("location: saisieinfo.php");
   // }

?>