<?php include "check-auth.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="styles/shop.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
   <link rel="stylesheet" href="styles/js-snackbar.css">
   <script src="scripts/js-snackbar.js"></script>
   <title>Panier</title>
   <style>
      body {
         display: flex;
         flex-direction: column;
         min-height: 100vh;
         justify-content: space-between;
      }
   </style>
</head>

<body>
   <?php
   include "components/navbar.php";
   ?>



   <section class="container content-section">
      <h2 class="section-header">Panier</h2>
      <?php
      $id = $_SESSION['id'];
      include "conn_db.php";
      include "components/cart-product.php";
      $lien = connect_db();
      $sql = "SELECT * FROM panier INNER JOIN produit ON panier.Ref_prod=produit.ref where panier.Num_clt=$id";
      $produits_cart = mysqli_query($lien, $sql) or die(mysqli_error($lien));
      if ($produits_cart->num_rows != 0) {
         echo '<div class="cart-row">
         <span class="cart-item cart-header cart-column">Article</span>
         <span class="cart-price cart-header cart-column">Prix</span>
         <span class="cart-quantity cart-header cart-column">Quantite</span>
      </div>';
      }
      ?>
      <div class="cart-items">
         <?php
         $total = 0;
         if ($produits_cart->num_rows == 0) {
            echo '<div style="text-align:center;margin:10px;">Votre panier est vide !</div>';
         } else {
            while ($prod = mysqli_fetch_assoc($produits_cart)) {
               $total += $prod['Prix'] * $prod['qty'];
               cart_product($prod['REF'], $prod['Designation'], $prod['Prix'], $prod['img_url'], $prod['qty']);
            }
         }
         ?>
      </div>
      <?php
      if ($produits_cart->num_rows != 0) {
         echo '<div class="cart-total">
            <strong class="cart-total-title">Total</strong>
            <span class="cart-total-price">' . $total . ' DH</span>
            </div><a href="checkout.php" class="btn-outline validerCommande">
         Valider La Commande
      </a>';
      }
      ?>
      
   </section>
   <script>
      const removeFromCart = refProd => {
         let body = new FormData();
         body.append('id_prod', refProd);
         body.append('remove_cart', '1');
         fetch('./cart-process.php', {
               method: "POST",
               body
            })
            .then(async res => {
               console.log(res.status);
               new SnackBar({
                  message: await res.text(),
                  status: res.status == 200 ? 'success' : 'error',
                  position: 'bl',
                  fixed: true,
               });
            })
      }
      document.querySelectorAll('.btn-danger')
         .forEach(btn => {
            btn.addEventListener('click', () => {
               let id_prod = btn.closest('.cart-row').id;
               removeFromCart(id_prod);
            });
         })
   </script>
   <?php include "components/footer.php " ?>
   <link rel="stylesheet" href="styles/panier.css">
   <script src="scripts/panier.js"></script>
</body>

</html>