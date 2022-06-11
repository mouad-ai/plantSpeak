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
    gap: 45px;
    flex-wrap: wrap;

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
        include('multipleCard.php');
        $lien = mysqli_connect('localhost','root','','pfe');
        $id =$_SESSION['id'];
        $sql = 'select * from project where ChefID="'.$id.'"';
        $result = mysqli_query($lien , $sql);
            while ( $row =mysqli_fetch_array($result)) {
                
                $name = $row['Titre'];
                $resp = $row['RespnsableID'];
                $sql = 'select * from personne where PersonneID="'.$resp.'"';
        $result = mysqli_query($lien , $sql);
        $row =mysqli_fetch_array($result);
                $prenom = $row['Prenom'];
                $nom = $row['Nom'];
                echo project($name,$prenom,$nom,'https://icon-library.com/images/project-icon-png/project-icon-png-16.jpg');
            }
        ?>


        <?php 
        
        $lien = mysqli_connect('localhost','root','','pfe');
        $id =$_SESSION['id'];
        $sql = 'select * from reunion where ChefID="'.$id.'"';
        $result = mysqli_query($lien , $sql);
        
        while ($row =mysqli_fetch_array($result)) {
            if ($row['Virtuelle']==1) {
            echo reunionV($row['Titre'],$row['lien'],'https://static.thenounproject.com/png/3016491-200.png' , $row['Date']);}
        if ($row['Physique']==1) {
            echo  reunionP($row['Titre'], $row['lieu'],'https://static.thenounproject.com/png/3016491-200.png',$row['Date']);
        }
        }
        
    ?>

    </div>
    <br>
    <br>
</main>
<script>
var body = document.body,
    html = document.documentElement;

var height = Math.max(body.scrollHeight, body.offsetHeight,
    html.clientHeight, html.scrollHeight, html.offsetHeight);
document.querySelector('.menu').style.height = height
</script>