<link rel="stylesheet" href="../styles/shop.css">
<link rel="stylesheet" href="../Botaniste/sideBar.css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Gestion des etudiants</title>
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
                    <a href="./">
                        <h2>Gestion <b>Des Etudiants</b></h2>
                    </a>
                    <div style="display: flex;">
                        <form action="" method="get" style="position: relative;">
                            <i class="fa-solid fa-magnifying-glass search-icon-admin"></i>
                            <input type="text" name="pid" class="search" placeholder="Par ID De etudiant">
                        </form>
                        <a class="btn add"><i class="fa-solid fa-square-plus"></i> <span>Ajouter Uu Botaniste</span></a>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="idB"></th>
                        <th>Email </th>
                        <th>Niveau</th>
                        <th>Universite </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                  function etudiant($BotanisteID,$email, $Niveau, $Universite)
                  {
                     return ' <tr>
                            <td  class="idB">' . $BotanisteID . '</td>
                            <td  class="email">' . $email . '</td>
                            <td contenteditable  class="niv">' . $Niveau . '</td>
                            <td contenteditable class="univer">' . $Universite. '</td>
                            <td>
                              <a  class="update" title="Update"><i class="fa-solid fa-pen"></i></a>
                              <a  class="delete" title="delete"><i class="fa-solid fa-trash"></i></a>
                           </td>
                        </tr>';
                  }
                 
                  $lien = mysqli_connect('localhost' ,'root','','pfe');
                
                 
                  if (isset($_GET["pid"]) and $_GET["pid"]) {
                      $id = $_GET['pid'];
                     $sql = 'SELECT *  FROM botaniste inner Join personne WHERE personne.PersonneID = botaniste.BotanistetID and BotanisteID = "'.$id.'" and botaniste.etudiant = 1 ';
                  } else {
                     $sql = 'SELECT *  FROM botaniste inner Join personne WHERE personne.PersonneID = botaniste.BotanisteID and botaniste.etudiant = 1 ';
                  }

                  $res = mysqli_query($lien, $sql) or die(mysqli_error($lien));
                  if ($res->num_rows == 0) {
                     echo "Aucun résultat.<br>";
                  }

                  while ($etudiant = mysqli_fetch_assoc($res)) {
                     echo etudiant($etudiant['BotanisteID'],$etudiant['Email'], $etudiant['Niveau'], $etudiant['Universite']);
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
const manageEtudiant = (mode, etudiant, title, response) => {
    console.log(etudiant)
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
            Object.keys(etudiant)
                .forEach(key => {
                    body.append(key, etudiant[key]);
                })
            fetch('./manageEtud', {
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
                        [...document.querySelectorAll('.idB')]
                        .find(e => e.innerText == etudiant.idB)
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
            let etudiant = getDataFromRow(btn.closest('tr'));
            console.log(etudiant)
            if (etudiant) {
                manageEtudiant('supprimer', etudiant,
                    `Vous êtes sûr que vous voulez supprimer ce(tte) ${etudiant.idB} ?`,
                    `Cet etudiant a été supprimé avec succès !`);
            }
        })
    })

// update listener
document.querySelectorAll('.update')
    .forEach(btn => {
        btn.addEventListener('click', () => {
            let etudiant = getDataFromRow(btn.closest('tr'));
            console.log(etudiant)
            if (etudiant) {
                manageEtudiant('modifier', etudiant,
                    `Êtes-vous sûr de vouloir modifier ce(tte) ${etudiant.idB} ?`,
                    `Cette etudiant a été modifié avec succès !`);
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
               <td  class="idB">dd</td>
               <td contenteditable class="email" > </td>
                            <td contenteditable  class="niv"></td>
                            <td  contenteditable class="univer"></td>

             <td>
               <a class="addEtudiant" onclick="addEtudiant(this.closest('tr'))">
                  <i class="fa-solid fa-square-plus"></i>
               </a>
             </td>`;
    })


const addEtudiant = tr => {
    let etudiant = getDataFromRow(tr);
    if (etudiant) {
        console.log(etudiant);
        manageEtudiant('ajouter', etudiant, `Vous êtes sûr de vouloir ajouter ce(tte) ${etudiant.idB} ?`,
            `Votre equipe a été ajouté avec succès !`);
    }
}
</script>