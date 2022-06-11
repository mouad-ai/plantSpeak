<?php
$emial = "dss";
$lien = mysqli_connect('localhost', 'root', '', 'pfe');
$id = 'select * from personne where Email="'.$emial.'"';
    $resultat  = mysqli_query($lien , $id);
    $id = mysqli_fetch_array($resultat);
    echo $id['PersonneID'];
    ?>