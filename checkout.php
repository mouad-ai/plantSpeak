 <?php include "check-auth.php"; ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Checkout</title>
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="styles/checkout.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
     <link rel="stylesheet" href="styles/shop.css">
 </head>

 <body>
     <script src="scripts/sweetalert.min.js"></script>
     <?php
      include "components/navbar.php";
      $id = $_SESSION['id'];
      include "conn_db.php";
      $lien = connect_db();
      $sql = "SELECT SUM(panier.qty * produit.Prix) as value_sum FROM panier INNER JOIN produit ON panier.Ref_prod=produit.ref where panier.Num_clt=$id";
      $produits_cart = mysqli_query($lien, $sql) or die(mysqli_error($lien));
      $row = mysqli_fetch_assoc($produits_cart);
      $sum = $row['value_sum'];
      if (isset($_GET['subject'])) {
         if ($sum > 0) {
            $addToCommand = "SELECT * FROM panier WHERE panier.Num_clt=$id";
            $result = mysqli_query($lien, $addToCommand) or die(mysqli_error($lien));
            $logdate = date('Y-m-d H:i:s');
            if(isset($_GET['name'])){
               // paiement par carte
               $modePaiement = '1';
            }else{
               $modePaiement = '0';
            }
            $commande = "INSERT INTO commande (NumClt, date,modePaiement) VALUES ('$id','$logdate',$modePaiement)";
            $result2 = mysqli_query($lien, $commande) or die(mysqli_error($lien));
            $getIdCommande = mysqli_query($lien, "SELECT LAST_INSERT_ID(Num) from commande order by LAST_INSERT_ID(Num) desc limit 1;") or die(mysqli_error($lien));
            $roow = mysqli_fetch_assoc($getIdCommande);
            $idCommande = $roow["LAST_INSERT_ID(Num)"];
            while ($data = mysqli_fetch_assoc($result)) {
               $refprod = $data['Ref_prod'];
               $quntity = $data['qty'];
               $insertIntoLC = "INSERT INTO lignedecommande (refprod, numcmd,qty )VALUES ('$refprod', '$idCommande','$quntity')";
               $result3 = mysqli_query($lien, $insertIntoLC) or die(mysqli_error($lien));
            }
            $deleteSql = "DELETE FROM panier where Num_clt=$id";
            $result4 = mysqli_query($lien, $deleteSql) or die(mysqli_error($lien));
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("Votre commande a bien été enregistrée !","Merci d utiliser notre site Web !","success");';
            echo '}, 500);</script>';
            echo "<script type='text/javascript'> setTimeout(function() {
         window.location.href = '/shop/shop.php'
     }, 3000); </script>";
         }
      }
      ?>
     <div class="wrapper">
         <div class="form-container">
             <h2 class="form-title">Détails de facturation</h2>
             <div class="radio-container">
                 <div class="radio-grp">
                     <input type="radio" name="paiement" id="enligne" checked>
                     <label for="enligne">Versement Bancaire</label>
                 </div>
                 <div class="radio-grp">
                     <input type="radio" name="paiement" id="livraison">
                     <label for="livraison">Paiement à la livraison</label>
                 </div>
             </div>
             <form action="" class="checkout-form" method="GET">
                 <div class="input-line">
                     <label for="name">Nom</label>
                     <input type="text" name="name" id="name" placeholder="Your name and surname">
                 </div>
                 <div class="input-line">
                     <label for="name">Numéro de carte</label>
                     <input type="text" name="name" id="name" placeholder="1111-2222-3333-4444">
                 </div>
                 <div class="input-container">
                     <div class="input-line">
                         <label for="name">Date d'expiration</label>
                         <input type="text" name="name" id="name" placeholder="09-21">
                     </div>
                     <div class="input-line">
                         <label for="name">CVC</label>
                         <input type="text" name="name" id="name" placeholder="***">
                     </div>
                 </div>
             </form>
             <p class="livraison" style="display: none;margin:40px 0;">Payer en argent comptant à la livraison.</p>
             <div class="footer-checkout">
                 <div class="total">
                     <h4>Total :</h4>
                     <?php echo round($sum, 2); ?> DH
                 </div>
                 <form action="checkout.php" method="get">

                     <!-- <input class="purchaseButton" type="submit" name="subject" value="Complete purchase"> -->
                     <input type="submit" name="subject" value="Commander" class="btn-outline"
                         style="font-size:18px;padding:10px 15px;" id="purchase">
                 </form>
             </div>
         </div>
     </div>
     <script>
     let enligne = document.querySelector('.checkout-form');
     let livraison = document.querySelector('.livraison');
     document.querySelectorAll('input[type="radio"]')
         .forEach(btn => {
             btn.addEventListener('change', () => {
                 if (btn.id == 'enligne') {
                     enligne.style.display = 'flex';
                     livraison.style.display = 'none';
                 } else {
                     livraison.style.display = 'block';
                     enligne.style.display = 'none';

                 }
             })
         })
     </script>

 </body>

 </html>