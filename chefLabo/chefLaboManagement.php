<link rel="stylesheet" href="../styles/shop.css">
<link rel="stylesheet" href="../Botaniste/sideBar.css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Gestion des Responsables</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<?php
include('sideBar.php');
?>
<div class="container">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <a href="./chefLaboManagement.php">
                        <h2>Gestion <b>Des Responsables</b></h2>
                    </a>
                    <div style="display: flex;">
                        <form action="" method="get" style="position: relative;">
                            <i class="fa-solid fa-magnifying-glass search-icon-admin"></i>
                            <input type="text" name="pid" class="search" placeholder="Par Nom De Responsable">
                        </form>
                        <a class="btn add"><i class="fa-solid fa-square-plus"></i> <span>Ajouter Uu
                                Responsable</span></a>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="idR">ID de responsable </th>
                        <th>Prenom</th>
                        <th>Nom </th>
                        <th>Email</th>
                        <th>Mot de passe</th>
                        <th>Photo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                  function botaniste($PlanteID, $Nom, $Prenom, $Email, $MotDePasse,$img)
                  {
                     return ' <tr>
                            <td  class="idR">' . $PlanteID . '</td>
                            <td contenteditable  class="nom">' . $Nom . '</td>
                            <td  contenteditable class="prenom">' . $Prenom . '</td>
                            <td contenteditable class="email">' . $Email. '</td>
                            <td contenteditable class="mdp">' . $MotDePasse. '</td>
                            <td contenteditable class="img_url"> <img src="' . $img . '" width="150px" height="150px" /></td>

                            <td>
                              <a  class="update" title="Update"><i class="fa-solid fa-pen"></i></a>
                              <a  class="delete" title="delete"><i class="fa-solid fa-trash"></i></a>
                           </td>
                        </tr>';
                  }
                 
                  $lien = mysqli_connect('localhost' ,'root','','pfe');
                
                 
                  if (isset($_GET["pid"]) and $_GET["pid"]) {
                      $id = $_GET['pid'];
                     $sql = 'SELECT *  FROM responsable inner Join personne WHERE personne.PersonneID = responsable.ResponsableID and personne.Nom= "'.$id.'" ';
                  } else {
                     $sql = 'SELECT *  FROM responsable inner Join personne WHERE personne.PersonneID = responsable.ResponsableID ';
                  }

                  $res = mysqli_query($lien, $sql) or die(mysqli_error($lien));
                  if ($res->num_rows == 0) {
                     echo "Aucun résultat.<br>";
                  }

                  while ($botaniste = mysqli_fetch_assoc($res)) {
                     echo botaniste($botaniste['ResponsableID'], $botaniste['Nom'], $botaniste['Prenom'], $botaniste['Email'] , $botaniste['MotDePasse'],$botaniste['img']);
                  }
                  ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="../scripts/sweetalert.js"></script>
<script>
const capitalize = s => {
    return s[0].toUpperCase() + s.slice(1);
}
const manageBotaniste = (mode, botaniste, title, response) => {
    console.log(botaniste)
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
            Object.keys(botaniste)
                .forEach(key => {
                    body.append(key, botaniste[key]);
                })
            fetch('./manageChefLab', {
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
                        [...document.querySelectorAll('.idR')]
                        .find(e => e.innerText == botaniste.idR)
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
    return obj;
}

document.querySelectorAll('.delete')
    .forEach(btn => {
        btn.addEventListener('click', () => {
            let botaniste = getDataFromRow(btn.closest('tr'));
            console.log(botaniste)
            if (botaniste) {
                manageBotaniste('supprimer', botaniste,
                    `Vous êtes sûr que vous voulez supprimer ${botaniste.prenom} ${botaniste.nom} ?`,
                    `Ce Responsable a été supprimé avec succès !`);
            }
        })
    })

// update listener
document.querySelectorAll('.update')
    .forEach(btn => {
        btn.addEventListener('click', () => {
            let botaniste = getDataFromRow(btn.closest('tr'));
            console.log(botaniste)
            if (botaniste) {
                manageBotaniste('modifier', botaniste,
                    `Êtes-vous sûr de vouloir modifier ${botaniste.prenom} ${botaniste.nom} ?`,
                    `Cette responsable a été modifié avec succès !`);
            }
        })
    })
</script>


<script>
var body = document.body,
    html = document.documentElement;

var height = Math.max(body.scrollHeight, body.offsetHeight,
    html.clientHeight, html.scrollHeight, html.offsetHeight);
document.querySelector('.menu').style.height = height;
document.querySelector('.add')
    .addEventListener('click', () => {
        let row = document.querySelector('table').insertRow(1);
        row.innerHTML = `
               <td  class="idR"></td>
                            <td contenteditable  class="nom"></td>
                            <td  contenteditable class="prenom"></td>
                            <td contenteditable class="email"></td>
                            <td contenteditable class="mdp"></td>
                            <td contenteditable class="img_url"> </td>
             <td>
               <a class="addBotaniste" onclick="addBotaniste(this.closest('tr'))">
                  <i class="fa-solid fa-square-plus"></i>
               </a>
             </td>`;
    })


const addBotaniste = tr => {
    let botaniste = getDataFromRow(tr);
    if (botaniste) {
        console.log(botaniste);
        manageBotaniste('ajouter', botaniste,
            `Vous êtes sûr de vouloir ajouter ${botaniste.prenom} ${botaniste.nom} ?`,
            `Ce Responsable a été ajouté avec succès !`);
    }
}
</script>