<link rel="stylesheet" href="../styles/shop.css">
<style>
.plants {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    gap: 40px;
    align-items: center;
    justify-content: space-around;
    padding-top: 40px;

}
</style>
<?php

include('sideBar.php');
?>

<div class="plants">
    <?php
    include ("PlanteCard.php");
    
    $lien = mysqli_connect('localhost' ,'root','','pfe');
    $id = $_SESSION['id'];
    $sql = 'select * from plante where BotanisteID="'.$id.'"';
    $result = mysqli_query($lien , $sql);
    while($ligne = mysqli_fetch_array($result)){
        echo plante($ligne['PlanteID'],$ligne['Nom'], $ligne['Description'],$ligne['Photo']);
    }
?>
</div>
<script>
document.querySelectorAll('.plante-card .consulter')
    .forEach(btn => {
        btn.addEventListener('click', () => {
            let id_prod = btn.closest('.plante-card').id;
            $link = "./plante.php?idPlante=" + id_prod;
            window.location.href = $link;

            console.log(id_prod)
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