<link rel="stylesheet" href="../styles/shop.css">
<link rel="stylesheet" href="../Botaniste/sideBar.css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Gestion administrative des equipes</title>
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
                    <a href="./equipes.php">
                        <h2>Gestion <b>Des Equipes</b></h2>
                    </a>
                    <div style="display: flex;">
                        <form action="" method="get" style="position: relative;">
                            <i class="fa-solid fa-magnifying-glass search-icon-admin"></i>
                            <input type="text" name="pid" class="search" placeholder="Par Nom De equipe">
                        </form>
                        <a class="btn add"><i class="fa-solid fa-square-plus"></i> <span>Ajouter Une
                                Equipe</span></a>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nom d'equipe</th>
                        <th class="idB">Id de botaniste</th>
                        <th>Email de botaniste</th>
                        <th class="idC">Votre ID</th>
                        <th>Email de chef d'equipe </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                  function equipe($Nom, $idB ,$emialB,$idC, $emialC)
                  {
                     return ' <tr>
                            <td contenteditable class="Nom">' . $Nom . '</td>
                            <td contenteditable  class="idB">' . $idB . '</td>
                            <td contenteditable  class="emailB">' . $emialB . '</td>
                            <td  class="idC">' . $idC. '</td>
                            <td  class="emailC">' . $emialC. '</td>
                            <td>
                              <a  class="update" title="Update"><i class="fa-solid fa-pen"></i></a>
                              <a  class="delete" title="Delete"><i class="fa-solid fa-trash"></i></a>
                           </td>
                        </tr>';
                  }
                  $lien = mysqli_connect('localhost' ,'root','','pfe');
                
                 
                  if (isset($_GET["pid"]) and $_GET["pid"]) {
                      $nom = $_GET['pid'];
                     $sql = 'SELECT equipe.nom as enom , BotanisteID , p1.Email as EmailB , p2.Email as EmailC , ChefID FROM equipe inner join personne as p1 on equipe.BotanisteID = p1.PersonneID inner join personne as p2 on equipe.ChefID= p2.PersonneID WHERE  equipe.Nom like "%'.$nom.'%"';
                  } else {
                     $sql = 'SELECT equipe.nom as enom , BotanisteID , p1.Email as EmailB , p2.Email as EmailC , ChefID FROM equipe inner join personne as p1 on equipe.BotanisteID = p1.PersonneID inner join personne as p2 on equipe.ChefID= p2.PersonneID';
                  }

                  $res = mysqli_query($lien, $sql) or die(mysqli_error($lien));
                  if ($res->num_rows == 0) {
                     echo "Aucun résultat.<br>";
                  }

                  while ($equipe = mysqli_fetch_assoc($res)) {
                     echo equipe($equipe['enom'], $equipe['BotanisteID'], $equipe['EmailB'], $equipe['ChefID'],$equipe['EmailC']);
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
const manageEquipe = (mode, equipe, title, response) => {
    console.log(equipe)
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
            Object.keys(equipe)
                .forEach(key => {
                    body.append(key, equipe[key]);
                })
            fetch('./manageEquipe.php', {
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
                        [...document.querySelectorAll('.Nom')]
                        .find(e => e.innerText == equipe.Nom)
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
// update listener
document.querySelectorAll('.update')
    .forEach(btn => {
        btn.addEventListener('click', () => {
            let equipe = getDataFromRow(btn.closest('tr'));
            console.log(equipe)
            if (equipe) {
                manageEquipe('modifier', equipe,
                    `Êtes-vous sûr de vouloir modifier ce(tte) ${equipe.Nom} ?`,
                    `Votre equipe a été modifié avec succès !`);
            }
        })
    })
// delete listener
document.querySelectorAll('.delete')
    .forEach(btn => {
        btn.addEventListener('click', () => {
            let equipe = getDataFromRow(btn.closest('tr'));
            console.log(equipe)
            if (equipe) {
                manageEquipe('supprimer', equipe,
                    `Vous êtes sûr que vous voulez supprimer l'equipe de Nom ${equipe.Nom} ?`,
                    `Cette equipe a été supprimé avec succès !`);
            }
        })
    })
const addEquipe = tr => {
    let equipe = getDataFromRow(tr);
    if (equipe) {
        console.log(equipe);
        manageEquipe('ajouter', equipe, `Vous êtes sûr de vouloir ajouter l'equipe de Nom  ${equipe.Nom} ?`,
            `Cette equipe a été ajouté avec succès !`);
    }
}

// add listener
document.querySelector('.add')
    .addEventListener('click', () => {
        let row = document.querySelector('table').insertRow(1);
        row.innerHTML = `
             <td contenteditable  class="Nom"></td>
             <td  class="idB">ss</td>
             <td contenteditable class="emailB">  &nbsp;</td>
             <td  class="idC">ss</td>
             <td contenteditable class="emailC"></td>
             <td>
               <a class="addEquipe" onclick="addEquipe(this.closest('tr'))">
                  <i class="fa-solid fa-square-plus"></i>
               </a>
             </td>`;
    })
</script>


<script>
var body = document.body,
    html = document.documentElement;

var height = Math.max(body.scrollHeight, body.offsetHeight,
    html.clientHeight, html.scrollHeight, html.offsetHeight);
document.querySelector('.menu').style.height = height
</script>