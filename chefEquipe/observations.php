<style>
.date {
    white-space: nowrap;
}
</style>
<link rel="stylesheet" href="../styles/shop.css">
<link rel="stylesheet" href="../Botaniste/sideBar.css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Gestion des observations</title>
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
                    <a href="./observations.php">
                        <h2>Gestion <b>Des observations</b></h2>
                    </a>
                    <div style="display: flex;">
                        <form action="" method="get" style="position: relative;">
                            <i class="fa-solid fa-magnifying-glass search-icon-admin"></i>
                            <input type="text" name="pid" class="search" placeholder="Par Name De Plante">
                        </form>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="idP">ID de Plante </th>
                        <th>Nom de Plante </th>
                        <th>Image de Plante </th>
                        <th class="idB">Id de botaniste</th>
                        <th>Email de botaniste</th>
                        <th>Date</th>
                        <th>Contenu</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                  function observation($PlanteID,$nom, $img, $BotanisteID,$emailB ,$Date, $Contenu)
                  {
                     return ' <tr>
                            <td  class="idP">' . $PlanteID . '</td>
                            <td  >' . $nom . '</td>
                            <td  class="img_url"> <img src="' . $img . '" width="100px" height="100px" /> </td>
                            <td   class="idB">' . $BotanisteID . '</td>
                            <td   class="emailB">' . $emailB . '</td>
                            <td  class="date">' . $Date . '</td>
                            <td  class="Contenu">' . $Contenu. '</td>
                            <td>
                              <a  class="delete consulter" title="delete"><i class="fa-solid fa-trash"></i></a>
                           </td>
                        </tr>';
                  }
                  $lien = mysqli_connect('localhost' ,'root','','pfe');
                
                 
                  if (isset($_GET["pid"]) and $_GET["pid"]) {
                      $nom = $_GET['pid'];
                     $sql = 'SELECT *  FROM observation inner join personne on personne.PersonneID = observation.PersonneID inner join plante on plante.PlanteID = observation.PlanteID WHERE plante.Nom = "'.$nom.'" ';
                  } else {
                     $sql = 'SELECT *  FROM observation inner join personne on personne.PersonneID = observation.PersonneID inner join plante on plante.PlanteID = observation.PlanteID';
                  }

                  $res = mysqli_query($lien, $sql) or die(mysqli_error($lien));
                  if ($res->num_rows == 0) {
                     echo "Aucun résultat.<br>";
                  }

                  while ($observation = mysqli_fetch_assoc($res)) {
                     echo observation($observation['PlanteID'],$observation['Nom'], $observation['Photo'], $observation['PersonneID'],$observation['Email'], $observation['Date'], $observation['Contenu']);
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
const manageEquipe = (mode, observation, title, response) => {
    console.log(observation)
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
            Object.keys(observation)
                .forEach(key => {
                    body.append(key, observation[key]);
                })
            fetch('./suppOb.php', {
                method: "POST",
                body
            }).then(res => {
                if (res.status == 200) {
                    Swal.fire(
                        `${capitalize(mode)} !`,
                        response,
                        'success'


                    );

                    setTimeout(() => {
                        location.reload();
                    }, 1000);

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
document.querySelectorAll('.delete')
    .forEach(btn => {
        btn.addEventListener('click', () => {
            let observation = getDataFromRow(btn.closest('tr'));
            console.log(observation)
            if (observation) {
                manageEquipe('supprimer', observation,
                    `Êtes-vous sûr de vouloir supprimer cette ${observation.Contenu} ?`,
                    `Cette observation a été supprimer avec succès !`);
            }
        })
    })
</script>


<script>
var body = document.body,
    html = document.documentElement;

var height = Math.max(body.scrollHeight, body.offsetHeight,
    html.clientHeight, html.scrollHeight, html.offsetHeight);
document.querySelector('.menu').style.height = height
</script>