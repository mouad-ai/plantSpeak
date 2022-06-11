<?php
    session_start();
    if(!isset($_SESSION['chef'])){
     header("location: ../authenticate.php");
 }
?>
<link rel="stylesheet" href="../Botaniste/sideBar.css">
<link rel="stylesheet" href="../styles/admin.css">
<nav class="menu" tabindex="0">
    <div class="smartphone-menu-trigger"></div>
    <header class="avatar">
        <img <?php echo 'src="'.$_SESSION['img'].'"' ?> />
        <h2><?php  echo $_SESSION['prenom'] ; echo " ".$_SESSION['nom'].""?></h2>
    </header>
    <ul>
        <li tabindex="0"><a class="sideBarButton" href="./">Dashboard</a></li>
        <li tabindex="0"><a class="sideBarButton" href="./equipes.php">Gestion des equipes</a></li>
        <li tabindex="0"><a class="sideBarButton" href="./PlanteManage.php">Gestion des plantes</a></li>
        <li tabindex="0"><a class="sideBarButton" href="./observations.php">Gestion des observations</a></li>
        <li tabindex="0"><a class="sideBarButton" href="../disconnect.php">Deconnecter</a></li>
    </ul>
</nav>