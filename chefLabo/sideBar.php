<?php 
session_start();
if(!isset($_SESSION['responsable'])){
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

        <li class="specialLi">
            <a class="sideBarButton" href="botanisteManagement.php">Gestion des Botanistes</a>
            <ul>
                <li class="innerButton"><a href="etudMangement.php">Gestion des etudiants</a></li>
                <li class="innerButton"><a href="stageManagement.php">Gestion des stagaires</a></li>
            </ul>
        </li>

        </a></li>
        <li tabindex="0"><a class="sideBarButton" href="chefEquipeManagement.php">Gestion des chefs d'equipes</a></li>
        <li tabindex="0"><a class="sideBarButton" href="chefLaboManagement.php">Gestion des chefs de laboratoire</a>
        </li>
        <li tabindex="0"><a class="sideBarButton" href="plante.php">Gestion des plants</a></li>
        <li tabindex="0"><a class="sideBarButton" href="project.php">Gestion des projects</a></li>
        <li tabindex="0"><a class="sideBarButton" href="gestionReunion.php">Gestion des reunions</a></li>
        <li tabindex="0"><a class="sideBarButton" href="../disconnect.php">Deconnecter</a></li>
    </ul>
</nav>