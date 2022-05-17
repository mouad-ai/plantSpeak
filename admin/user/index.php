<!DOCTYPE html>
<html lang="en">

<?php
if ( !isset($_SESSION['isAdmin']) or $_SESSION['isAdmin']=="0") {
              header("Location: http://localhost/shop/shop.php");
die();
            }
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Gestion des utilisateurs Admin</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
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
                            <h2>Gestion <b>Des Utilisateurs</b></h2>
                        </a>
                        <div style="display: flex;">
                            <form action="" method="get" style="position: relative;">
                                <i class="fa-solid fa-magnifying-glass search-icon-admin"></i>
                                <input type="text" name="uid" class="search" placeholder="Par ID D'utilisateur">
                            </form>
                            <a class="btn addUserRow"><i class="fa-solid fa-square-plus"></i> <span>Ajouter Un
                                    Utilisateur</span></a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nom</th>
                            <th>N de Téléphone</th>
                            <th>Adresse</th>
                            <th>Ville</th>
                            <th>Mot de passe</th>
                            <th>Email</th>
                            <th>isAdmin</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                  function user($id, $name, $tel, $adresse, $ville, $password, $email, $isAdmin)
                  {
                     return ' <tr>
                            <td class="id">' . $id . '</td>
                            <td contenteditable class="name">' . $name . '</td>
                            <td contenteditable class="tel">' . $tel . '</td>
                            <td contenteditable class="adresse">' . $adresse . '</td>
                            <td contenteditable class="ville">' . $ville . '</td>
                            <td contenteditable class="password"> ' . $password . '</td>
                            <td contenteditable class="email"> ' . $email . '</td>
                            <td contenteditable class="isAdmin">
                                ' . $isAdmin . '
                            </td>
                            <td>
                              <a  class="update" title="Update"><i class="fa-solid fa-pen"></i></a>
                              <a  class="delete" title="Delete"><i class="fa-solid fa-trash"></i></a>
                           </td>
                        </tr>';
                  }
                  require('../../conn_db.php');
                  $lien = connect_db();

                  if (isset($_GET["uid"]) and $_GET["uid"]) {
                     $sql = "SELECT * FROM client where id like " . $_GET["uid"] . "";
                  } else {
                     $sql = "SELECT * FROM client";
                  }

                  $res = mysqli_query($lien, $sql) or die(mysqli_error($lien));
                  if ($res->num_rows == 0) {
                     echo "Aucun résultat.<br>";
                  }

                  while ($user = mysqli_fetch_assoc($res)) {
                     echo user($user['id'], $user['name'], $user['tel'], $user['adresse'], $user['ville'], $user['password'], $user['email'], $user['isAdmin']);
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
    const manageUser = (mode, user, title, response) => {
        console.log(user)
        Swal.fire({
            title,
            text: "C'est Une option Irréversible !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: `${capitalize(mode)} !`
        }).then((result) => {
            if (result.isConfirmed) {
                let body = new FormData();
                body.append(mode, '1');
                Object.keys(user)
                    .forEach(key => {
                        body.append(key, user[key]);
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
                            [...document.querySelectorAll('.id')]
                            .find(e => e.innerText == user.id)
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
                    obj[td.className] = td.innerText;
                }
            });
        return Object.values(obj).some(e => !e) ? false : obj;
    }
    // update listener
    document.querySelectorAll('.update')
        .forEach(btn => {
            btn.addEventListener('click', () => {
                let user = getDataFromRow(btn.closest('tr'));
                if (user) {
                    manageUser('modifier', user, `Êtes-vous sûr de vouloir modifier ${user.name} ?`,
                        `Votre produit a été modifié avec succès !`);
                }
            })
        })
    // delete listener
    document.querySelectorAll('.delete')
        .forEach(btn => {
            btn.addEventListener('click', () => {
                let user = getDataFromRow(btn.closest('tr'));
                if (user) {
                    manageUser('supprimer', user,
                        `Vous êtes sûr que vous voulez supprimer ${user.name} ?`,
                        `Votre produit a été supprimé avec succès !`);
                }
            })
        })
    const addUser = tr => {
        let user = getDataFromRow(tr);
        if (user) {
            console.log(user);
            manageUser('ajouter', user, `Vous êtes sûr de vouloir ajouter ${user.name} ?`,
                `Votre produit a été ajouté avec succès !`);
        }
    }
    // add listener
    document.querySelector('.addUserRow')
        .addEventListener('click', () => {
            let row = document.querySelector('table').insertRow(1);
            row.innerHTML = `
             <td></td>
             <td contenteditable class="name"></td>
             <td contenteditable class="tel"></td>
             <td contenteditable class="adresse"></td>
             <td contenteditable class="ville"></td>
             <td contenteditable class="password"></td>
             <td contenteditable class="email"></td>
             <td contenteditable class="isAdmin"></td>
             <td>
               <a class="addUser" onclick="addUser(this.closest('tr'))">
                  <i class="fa-solid fa-square-plus"></i>
               </a>
             </td>
            `;

        })
    </script>
    <?php include "../../components/footer.php"; ?>
</body>

</html>