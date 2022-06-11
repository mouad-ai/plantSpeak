<link rel="stylesheet" href="sideBar.css">
<link rel="stylesheet" href="../styles/shop.css">
<style>
.helper {
    text-align: center;

}

.bonjour {
    padding: 24px;
    margin-top: 20px;
    line-height: 100px;
    border: 3px solid white;
    border-radius: 10px;
    text-transform: uppercase;
    background-color: #0c8195;
    color: white;
    font-weight: bolder;
}


.info {
    display: flex;
    margin-top: 40px;
    justify-content: space-around;
    text-align: center;
    align-items: center;
    gap: 20px;

}

.info img {
    justify-content: center;
}

h1 {}
</style>
<?php
    include('sideBar.php');
?>

<main>
    <div class="helper">

        <span class="bonjour">
            BIENVENUE SUR NOTRE NOUVEAU SITE WEB
            <!-- Bonjour: <?php echo $_SESSION['prenom'] ;echo " ".$_SESSION['nom'].""?> -->
        </span>
    </div>
    <div class="info">

        <?php
        include('PlanteCard.php');
        $lien = mysqli_connect('localhost','root','','pfe');
        $id =$_SESSION['id'];
        $sql = 'select * from equipe where BotanisteID="'.$id.'"';
        $result = mysqli_query($lien , $sql);
        $row =mysqli_fetch_array($result);
            if ($row) {
                $name = $row['Nom'];
                $chef = $row['ChefID'];
                $sql = 'select * from personne where PersonneID="'.$chef.'"';
        $result = mysqli_query($lien , $sql);
        $row =mysqli_fetch_array($result);
                $prenom = $row['Prenom'];
                $nom = $row['Nom'];
                echo equiipe($name,$prenom,$nom,'https://advocate.berkeley.edu/wp-content/uploads/2017/02/group-copy-1416476921gn4k8.png');
            }
        ?>


        <?php 
        
        $lien = mysqli_connect('localhost','root','','pfe');
        $id =$_SESSION['id'];
        $sql = 'select * from botaniste where botanisteID="'.$id.'"';
        $result = mysqli_query($lien , $sql);
        $row =mysqli_fetch_array($result);
        if ($row['etudiant']==1) {
            echo etudaint($row['Niveau'],$row['Universite'],'https://cdn.icon-icons.com/icons2/1674/PNG/512/person_110935.png');}
        if ($row['stagaire']==1) {
            echo  stagaire($row['Duree'],'https://cdn.icon-icons.com/icons2/1674/PNG/512/person_110935.png');
        }
    ?>
    </div>
</main>
<script>
var body = document.body,
    html = document.documentElement;

var height = Math.max(body.scrollHeight, body.offsetHeight,
    html.clientHeight, html.scrollHeight, html.offsetHeight);
document.querySelector('.menu').style.height = height
</script>