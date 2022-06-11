<?php
 session_start();
 if(!isset($_SESSION['botaniste'])){
     header("location: ../authenticate.php");
 }
?>
<link rel="stylesheet" href="./sideBar.css">
<nav class="menu" tabindex="0">
    <div class="smartphone-menu-trigger"></div>
    <header class="avatar">
        <img <?php echo 'src="'.$_SESSION['img'].'"' ?> />
        <h2><?php  echo $_SESSION['prenom'] ; echo " ".$_SESSION['nom'].""?></h2>
    </header>
    <ul>
        <li tabindex="0"><a class="sideBarButton" href="./">Dashboard</a></li>
        <li tabindex="0"><a class="sideBarButton" href="./consulter.php">Consulter mes plantes</a></li>
        <li tabindex="0"><a class="sideBarButton" href="./myObservations.php">Mes observations</a></li>
        <li tabindex="0"><a class="sideBarButton" href="../disconnect.php">Deconnecter</a></li>
    </ul>
</nav>