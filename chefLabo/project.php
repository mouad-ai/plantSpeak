<link rel="stylesheet" href="../styles/shop.css">
<link rel="stylesheet" href="../Botaniste/sideBar.css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Gestion des Projects</title>
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
                    <a href="./project.php">
                        <h2>Gestion <b>Des Projets</b></h2>
                    </a>
                    <div style="display: flex;">
                        <form action="" method="get" style="position: relative;">
                            <i class="fa-solid fa-magnifying-glass search-icon-admin"></i>
                            <input type="text" name="pid" class="search" placeholder="Par le Titre de Projet">
                        </form>
                        <a class="btn add"><i class="fa-solid fa-square-plus"></i> <span>Ajouter Un Projet</span></a>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="idR">ID de Responsable </th>
                        <th class="emialR">Email de Responsable </th>
                        <th class="idC">ID de Chef d'equipe</th>
                        <th class="emailC">Email de Chef d'equipe</th>
                        <th>Titre </th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                  function project($ResponsableID,$emialR , $ChefID, $emailC, $Titre, $Date)
                  {
                     return ' <tr>
                            <td  class="idR">' . $ResponsableID . '</td>
                            <td  class="emailR">' . $emialR . '</td>
                            <td   class="idC">' . $ChefID . '</td>
                            <td   class="emailC">' . $emailC . '</td>
                            <td   class="titre">' . $Titre . '</td>
                            <td  class="date">' . $Date. '</td>
                            

                            <td>
                              <a  class="delete" title="delete"><i class="fa-solid fa-trash"></i></a>
                           </td>
                        </tr>';
                  }
                 
                  $lien = mysqli_connect('localhost' ,'root','','pfe');
                
                 
                  if (isset($_GET["pid"]) and $_GET["pid"]) {
                      $id = $_GET['pid'];
                      $sql = $sql = 'SELECT a.Email as EmailR , p.Date , p.Titre , p.RespnsableID , p.ChefID , c.Email as EmailC  FROM  project p INNER JOIN personne c ON p.ChefID = c.PersonneID 
                      INNER JOIN personne a ON a.PersonneID = p.RespnsableID where p.Titre = "'.$id.'" ';
                     
                  } else {
                     $sql = 'SELECT a.Email as EmailR , p.Date , p.Titre , p.RespnsableID , p.ChefID , c.Email as EmailC  FROM  project p INNER JOIN personne c ON p.ChefID = c.PersonneID 
                      INNER JOIN personne a ON a.PersonneID = p.RespnsableID';
                  }

                  $res = mysqli_query($lien, $sql) or die(mysqli_error($lien));
                  if ($res->num_rows == 0) {
                     echo "Aucun résultat.<br>";
                  }

                  while ($project = mysqli_fetch_assoc($res)) {
                     echo project($project['RespnsableID'],$project['EmailR'], $project['ChefID'],$project['EmailC'] ,$project['Titre'], $project['Date'] );
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
const manageProject = (mode, botaniste, title, response) => {
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
            fetch('./manageProject', {
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
                        [...document.querySelectorAll('.idC')]
                        .find(e => e.innerText == botaniste.idC)
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
            let project = getDataFromRow(btn.closest('tr'));
            console.log(project)
            if (project) {
                manageProject('supprimer', project,
                    `Vous êtes sûr que vous voulez supprimer ce project de titre ${project.titre} ?`,
                    `Ce project a été supprimé avec succès !`);
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
               <td   class="idR"></td>
               <td contenteditable  class="emailR"></td>
                            <td   class="idC"></td>
                            <td contenteditable  class="emailC"></td>
                            <td  contenteditable class="titre"></td>
                            <td  class="date"> &nbsp; [autofill] </td>
                            
             <td>
               <a class="addProject" onclick="addProject(this.closest('tr'))">
                  <i class="fa-solid fa-square-plus"></i>
               </a>
             </td>`;
    })


const addProject = tr => {
    let botaniste = getDataFromRow(tr);
    if (botaniste) {
        console.log(botaniste);
        manageProject('ajouter', botaniste,
            `Vous êtes sûr de vouloir ajouter ce project de titre ) ${botaniste.titre} ?`,
            `Ce project a été ajouté avec succès !`);
    }
}
</script>