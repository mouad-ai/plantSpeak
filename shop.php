<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shop</title>
   <link rel="stylesheet" href="styles/shop.css">
   <link rel="stylesheet" href="styles/js-snackbar.css">
   <script src="scripts/js-snackbar.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

</head>

<body>
   <?php
   session_start();
   if (isset($_SESSION['email'])) {
      var_dump($_SESSION);
   } else {
      echo "not connected";
   }
   include "components/product.php";
   include "components/navbar.php";
   include "sidebar.php";
   ?>
   <div class="products">
      <?php
      require('conn_db.php');
      $lien = connect_db();
      if (isset($_GET["priceRange"])) {
         $query = $_GET['priceRange'];
         switch ($query) {
            case "decroissant":
               $sql = "SELECT * FROM produit order by Prix DESC";
               break;
            case "croissant":
               $sql = "SELECT * FROM produit order by Prix asc";
               break;
            default:
               $sql = "SELECT * FROM produit";
         }
      }elseif(isset($_GET['q'])) {
         $input = $_GET['q'];
         $sql = "SELECT * FROM produit where Designation LIKE '%" . $_GET['q'] . "%'";
      } else {
         $sql = "SELECT * FROM produit";
      }
      $res = mysqli_query($lien, $sql) or die(mysqli_error($lien));
      if ($res->num_rows == 0) {
         echo "Aucun résultat pour {$input}.<br>
        - Essayez avec un autre mot clé ou synonyme.<br>
        - Essayez d'effectuer une recherche plus générale, vous pourrez ensuite filtrer les résultats obtenus";
      }
      while ($product = mysqli_fetch_assoc($res)) {
         echo product($product['REF'], $product['categorie'], $product['img_url'], $product['Prix'], $product['Designation']);
      }
      ?>
   </div>
   <?php include "components/footer.php" ?>
   <!-- manage checkboxes -->
   <script>
      // manage checkboxes
      const show = (elements) => {
         elements.forEach(el => {
            el.style.display = "block";
         })
      }
      const hide = (elements) => {
         elements.forEach(el => {
            el.style.display = "none";
         })
      }
      let minPrice = document.querySelector('#min-price');
      let maxPrice = document.querySelector('#max-price');

      minPrice.addEventListener('input', () => {
         let min_products = [...document.querySelectorAll('.product-card:not([style])')]
            .filter(prod => {
               return Number(prod.querySelector('.price').textContent.split(' ')[0]) <= Number(minPrice.value);
            });
         let max_products = [...document.querySelectorAll('.product-card:not([style])')]
            .filter(prod => Number(prod.querySelector('.price').textContent.split(' ')[0]) >= Number(minPrice.value) && (maxPrice.value ? Number(prod.querySelector('.price').textContent.split(' ')[0]) <= Number(maxPrice.value) : true));
         show(max_products);
         hide(min_products);
      })
      maxPrice.addEventListener('input', () => {
         let max_products = [...document.querySelectorAll('.product-card:not([style])')]
            .filter(prod => {
               return Number(prod.querySelector('.price').textContent.split(' ')[0]) >= Number(maxPrice.value);
            });
         let min_products = [...document.querySelectorAll('.product-card:not([style])')]
            .filter(prod => Number(prod.querySelector('.price').textContent.split(' ')[0]) <= Number(maxPrice.value) && (minPrice.value ? Number(prod.querySelector('.price').textContent.split(' ')[0]) >= Number(minPrice.value) : true));
         show(min_products);
         hide(max_products);
      })
      const showProductsAndHide = () => {
         let checkedCategories = [...document.querySelectorAll('.checklist a.checked')].map(e => e.textContent.toLowerCase().trim());
         let productsToShow = [...document.querySelectorAll(`.product-card`)]
            .filter(e => checkedCategories.includes(e.querySelector('.title').textContent.toLowerCase().trim()));
         let productsToHide = [...document.querySelectorAll('.product-card')]
            .filter(e => !productsToShow.includes(e))
         hide(productsToHide);
         show(productsToShow)
      }
      let checkBoxes = document.querySelectorAll('.checklist.categories a');
      checkBoxes
         .forEach(a => {
            a.addEventListener('click', () => {
               if (a.classList.contains('checked')) {
                  a.classList.remove('checked');
                  a.querySelectorAll('span span')
                     .forEach(span => {
                        span.classList.remove('animate');
                     })
                  let notCheckedCategories = [...document.querySelectorAll('.checklist.categories a:not(.checked)')].map(e => e.textContent.toLowerCase().trim());
                  let products = document.querySelectorAll('.product-card');
                  if (checkBoxes.length == notCheckedCategories.length) {
                     show(products);
                  } else {
                     showProductsAndHide();
                  }
               } else {
                  a.classList.add('checked')
                  a.querySelectorAll('span span')
                     .forEach(span => {
                        span.classList.add('animate');
                     });
                  showProductsAndHide();
               }
            })
         })
   </script>

   <!-- manage cart -->
   <script>
      const addToCart = refProd => {
         let body = new FormData();
         body.append('id_prod', refProd);
         body.append('add_cart', '1');
         fetch('./cart-process.php', {
               method: "POST",
               body
            })
            .then(async res => {
               new SnackBar({
                  message: await res.text(),
                  status: res.status == 200 ? 'success' :'error',
                  position: 'bl',
                  fixed:true,
               });
            })
            .then(res => console.log(res));
      }
      document.querySelectorAll('.product-card .addCart')
         .forEach(btn => {
            btn.addEventListener('click', () => {
               let id_prod = btn.closest('.product-card').id;
               addToCart(id_prod);
            })
         })
   </script>
</body>

</html>