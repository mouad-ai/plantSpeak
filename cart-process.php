<?php
   session_start();
   if(!isset($_SESSION['email'])){
      // not connected
      echo 'Please Identify yourself before adding products into cart';
      http_response_code(400);
      exit;
   }
   require('conn_db.php');
   $lien = connect_db();
   function check_prod($lien,$ref_prod){
      $check_prod = "SELECT * FROM produit where REF=$ref_prod";
      $produit = mysqli_query($lien, $check_prod) or die(mysqli_error($lien));
      if ($produit->num_rows == 0) {
         echo 'produit undefined';
         http_response_code(400);
         exit;
      }
   }
   function get_prod_cart($lien,$ref_prod,$cli){
      $sql = "SELECT * FROM panier where Ref_prod=$ref_prod and Num_clt=$cli";
      $produit = mysqli_query($lien, $sql) or die(mysqli_error($lien));
      return $produit->num_rows == 0 ? false : true; 
   }
   $id_client = $_SESSION['id'];
   $prod = $_POST['id_prod'];
   if(isset($_POST['add_cart'])){
      check_prod($lien,$prod);
      // if prod already exists in cart => skip
      if(!get_prod_cart($lien, $prod,$id_client)){
         $sql = "INSERT INTO panier(Num_clt,Ref_prod,qty) VALUES($id_client,$prod,1)";
         mysqli_query($lien, $sql) or die(mysqli_error($lien));
         echo 'product added to cart successfully !';
         http_response_code(200);
         exit;
         // insert successfully
      }
      echo 'product is already in cart';
      http_response_code(400);
      exit;
   }
   if(isset($_POST['remove_cart'])){
      check_prod($lien, $prod);
      if (get_prod_cart($lien, $prod,$id_client)) {
         $sql = "DELETE FROM panier WHERE Ref_prod=$prod and Num_clt=$id_client";
         mysqli_query($lien, $sql) or die(mysqli_error($lien));
         echo 'product deleted from cart successfully !';
         http_response_code(200);
         exit;
         // deleted successfully
      }
      echo 'product isnt in cart';
      http_response_code(400);
      exit;
   }
   if(isset($_POST['update_cart'])){
      // update qty
      check_prod($lien, $prod);
      if(get_prod_cart($lien,$prod,$id_client)){
         $qty = $_POST['qty'];
         $sql = "UPDATE panier set qty=$qty WHERE Ref_prod=$prod and Num_clt=$id_client";
         mysqli_query($lien, $sql) or die(mysqli_error($lien));
      }
   }
   // echo $_POST['test'];
   // if(isset($_POST['']))
?>