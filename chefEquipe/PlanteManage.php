<link rel="stylesheet" href="../styles/shop.css">
<link rel="stylesheet" href="../Botaniste/sideBar.css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Gestion des plantes</title>
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
                    <a href="./PlanteManage.php">
                        <h2>Gestion <b>Des Plantes</b></h2>
                    </a>
                    <div style="display: flex;">
                        <form action="" method="get" style="position: relative;">
                            <i class="fa-solid fa-magnifying-glass search-icon-admin"></i>
                            <input type="text" name="pid" class="search" placeholder="Par Nom De plante">
                        </form>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="idP">ID de Plante </th>
                        <th class="idB">Id de botaniste</th>
                        <th>Email de botaniste </th>
                        <th>Nom de Plante</th>
                        <th>DESCRITION</th>
                        <th>Image</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                  function plante($PlanteID, $idB,$emialB,  $nomP, $Desc, $img_url)
                  {
                     return ' <tr>
                            <td  class="idP">' . $PlanteID . '</td>
                            <td   class="idB">' . $idB . '</td>
                            <td contenteditable  class="emailB">' . $emialB . '</td>
                            <td  class="nomB">' . $nomP . '</td>
                            <td  class="desc">' . $Desc. '</td>
                            <td class="img_url"> <img src="' . $img_url . '" width="150px" height="150px" /></td>

                            <td>
                              <a  class="update" title="Update"><i class="fa-solid fa-pen"></i></a>
                           </td>
                        </tr>';
                  }
                  $lien = mysqli_connect('localhost' ,'root','','pfe');
                
                 
                   if (isset($_GET["pid"]) and $_GET["pid"]) {
                      $nom = $_GET['pid'];
                     $sql = 'SELECT *  FROM plante  WHERE Nom = "'.$nom.'" and BotanisteID IS NULL  ';
                  } else {
                     $sql = 'SELECT *  FROM plante WHERE BotanisteID IS NULL  ';
                  }
                                    $res = mysqli_query($lien, $sql) or die(mysqli_error($lien));

                  

                  while ($plante = mysqli_fetch_assoc($res)) {
                     echo plante($plante['PlanteID'], $plante['BotanisteID'],'', $plante['Nom'], $plante['Description'] , $plante['Photo']);
                  }



                  if (isset($_GET["pid"]) and $_GET["pid"]) {
                      $nom = $_GET['pid'];
                     $sql = 'SELECT *  FROM plante inner join personne on personne.PersonneID = plante.BotanisteID WHERE Nom = "'.$nom.'"  ';
                  } else {
                     $sql = 'SELECT *  FROM plante inner join personne on plante.BotanisteID =  personne.PersonneID  ';
                  }

                  $res = mysqli_query($lien, $sql) or die(mysqli_error($lien));
                  

                  while ($plante = mysqli_fetch_assoc($res)) {
                     echo plante($plante['PlanteID'], $plante['BotanisteID'],$plante['Email'], $plante['Nom'], $plante['Description'] , $plante['Photo']);
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
const manageEquipe = (mode, plante, title, response) => {
    console.log(plante)
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
            Object.keys(plante)
                .forEach(key => {
                    body.append(key, plante[key]);
                })
            fetch('./manage.php', {
                method: "POST",
                body
            }).then(res => {
                if (res.status == 200) {
                    Swal.fire(
                        `${capitalize(mode)} !`,
                        response,
                        'success'
                    );


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
            let plante = getDataFromRow(btn.closest('tr'));
            console.log(plante)
            if (plante) {
                manageEquipe('modifier', plante,
                    `Êtes-vous sûr de vouloir modifier ce(tte) ${plante.idP} ?`,
                    `Cette plante a été modifié avec succès !`);
            }
        })
    })


$consulter = document.querySelectorAll('.consulter').forEach(btn => {
    btn.addEventListener('click', () => {
        let idP = getDataFromRow(btn.closest('tr'))['idP'];
        console.log(getDataFromRow(btn.closest('tr'))["idP"])
        location.href = "./consulter.php?idPlante=" + idP;
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