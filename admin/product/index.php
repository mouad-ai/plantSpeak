<!DOCTYPE html>
<html lang="en">
<?php
if ( !isset($_SESSION['isAdmin']) or $_SESSION['isAdmin'] == "0") {
              header("Location: http://localhost/shop/shop.php");

die();
            } 
            
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Gestion administrative des produits</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> -->
    <link rel="stylesheet" href="../../styles/admin.css">
    <link rel="stylesheet" href="../../styles/shop.css">
    <style>

    </style>
</head>

<body>
    <?php include "../../components/navbar.php" ?>

    <div class="container">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <a href="./">
                            <h2>Gestion <b>Des Produits</b></h2>
                        </a>
                        <div style="display: flex;">
                            <form action="" method="get" style="position: relative;">
                                <i class="fa-solid fa-magnifying-glass search-icon-admin"></i>
                                <input type="text" name="pid" class="search" placeholder="Par REF De Produit">
                            </form>
                            <a class="btn addproductRow"><i class="fa-solid fa-square-plus"></i> <span>Ajouter Un
                                    Produit</span></a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>N de Reference</th>
                            <th>Prix</th>
                            <th>Designation</th>
                            <th>Categorie</th>
                            <th>Prix Acquisition</th>
                            <th>Image</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                  function produit($REF, $Prix, $Desgination, $categorie, $prixacquisition, $img_url)
                  {
                     return ' <tr>
                            <td class="REF">' . $REF . '</td>
                            <td contenteditable class="Prix">' . $Prix . '</td>
                            <td contenteditable class="Designation">' . $Desgination . '</td>
                            <td contenteditable class="categorie">' . $categorie . '</td>
                            <td contenteditable class="prixacquisition">' . $prixacquisition . '</td>
                            <td class="img_url"> <img src="' . $img_url . '" width="150px" height="150px" /></td>
                            <td>
                              <a  class="update" title="Update"><i class="fa-solid fa-pen"></i></a>
                              <a  class="delete" title="Delete"><i class="fa-solid fa-trash"></i></a>
                           </td>
                        </tr>';
                  }
                  require('../../conn_db.php');
                  $lien = connect_db();
                  if (isset($_GET["pid"]) and $_GET["pid"]) {
                     $sql = "SELECT * FROM produit where REF like " . $_GET["pid"] . "";
                  } else {
                     $sql = "SELECT * FROM produit";
                  }

                  $res = mysqli_query($lien, $sql) or die(mysqli_error($lien));
                  if ($res->num_rows == 0) {
                     echo "Aucun résultat.<br>";
                  }

                  while ($produit = mysqli_fetch_assoc($res)) {
                     echo produit($produit['REF'], $produit['Prix'], $produit['Designation'], $produit['categorie'], $produit['prixacquisition'], $produit['img_url']);
                  }
                  ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="../../scripts/sweetalert.js"></script>
    <script>
    const capitalize = s => {
        return s[0].toUpperCase() + s.slice(1);
    }
    const manageProduct = (mode, product, title, response) => {
        console.log(product)
        Swal.fire({
            title,
            text: "C'est Une option Irréversible!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: `${capitalize(mode)} !`
        }).then((result) => {
            if (result.isConfirmed) {
                let body = new FormData();
                body.append(mode, '1');
                Object.keys(product)
                    .forEach(key => {
                        body.append(key, product[key]);
                    })
                fetch('./manage', {
                    method: "POST",
                    body
                }).then(res => {
                    if (res.status == 200) {
                        Swal.fire(
                            `${capitalize(mode)} !`,
                            response,
                            'success'
                        );
                        if (mode == 'ajouter') {
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        }
                        if (mode == 'supprimer') {
                            [...document.querySelectorAll('.REF')]
                            .find(e => e.innerText == product.REF)
                                .closest('tr')
                                .innerHTML = '';
                        }
                    } else {
                        Swal.fire(
                            'Error !',
                            'Il y a un problème.',
                            'error'
                        )
                    }
                })
            }
        })
    }
    const getDataFromRow = tr => {
        let obj = {};
        tr.querySelectorAll('td')
            .forEach(td => {
                if (td.className) {
                    if (td.className == 'img_url') {
                        if (td.querySelector('img')) {
                            obj[td.className] = td.querySelector('img').src;
                        } else {
                            obj[td.className] = td.innerText;
                        }
                    } else {
                        obj[td.className] = td.innerText;
                    }
                }
            });
        console.log(obj);
        return Object.values(obj).some(e => !e) ? false : obj;
    }
    // update listener
    document.querySelectorAll('.update')
        .forEach(btn => {
            btn.addEventListener('click', () => {
                let product = getDataFromRow(btn.closest('tr'));
                console.log(product)
                if (product) {
                    manageProduct('modifier', product,
                        `Êtes-vous sûr de vouloir modifier ce(tte) ${product.categorie} ?`,
                        `Votre produit a été modifié avec succès !`);
                }
            })
        })
    // delete listener
    document.querySelectorAll('.delete')
        .forEach(btn => {
            btn.addEventListener('click', () => {
                let product = getDataFromRow(btn.closest('tr'));
                console.log(product)
                if (product) {
                    manageProduct('supprimer', product,
                        `Vous êtes sûr que vous voulez supprimer ce(tte) ${product.categorie} ?`,
                        `Votre produit a été supprimé avec succès !`);
                }
            })
        })
    const addproduct = tr => {
        let product = getDataFromRow(tr);
        if (product) {
            console.log(product);
            manageProduct('ajouter', product, `Vous êtes sûr de vouloir ajouter ce(tte) ${product.categorie} ?`,
                `Votre produit a été ajouté avec succès !`);
        }
    }
    document.querySelectorAll('.img_url')
        .forEach(td => {
            td.addEventListener('click', () => {
                console.log('focus')
                if (td.querySelector('img')) {
                    td.innerHTML = td.querySelector('img').src;
                    td.setAttribute('contenteditable', 'true');
                    td.focus();
                }
            });
            td.addEventListener('blur', () => {
                console.log('blur');
                td.innerHTML = `<img src="${td.innerText}" width="150px" height="150px" />`;
                td.setAttribute('contenteditable', 'false');
            })
        });
    // add listener
    document.querySelector('.addproductRow')
        .addEventListener('click', () => {
            let row = document.querySelector('table').insertRow(1);
            row.innerHTML = `
             <td contenteditable class="REF"></td>
             <td contenteditable class="Prix"></td>
             <td contenteditable class="Designation"></td>
             <td contenteditable class="categorie"></td>
             <td contenteditable class="prixacquisition"></td>
             <td contenteditable class="img_url"></td>
             <td>
               <a class="addproduct" onclick="addproduct(this.closest('tr'))">
                  <i class="fa-solid fa-square-plus"></i>
               </a>
             </td>`;
        })
    </script>
    <?php include "../../components/footer.php"; ?>

</body>

</html>