<form action="test.php" method="post">

    <input type="text" name="emailC">
    <input type="text" name="emialB">
    <input type="text" name="Nom">
    <input type="submit" value="envoyer">

</form>
<?php


                  $lien = mysqli_connect('localhost' ,'root','','pfe');

if( isset($_POST['Nom']) && isset($_POST['emailB']) && isset($_POST['emailC']) ){


      $Nom = $_POST['Nom'];

       $id = 'select * from personne where Email="'.$_POST['emailB'].'"';
    $resultat  = mysqli_query($lien , $id);
    $idB = mysqli_fetch_array($resultat);
   $id = 'select * from personne where Email="'.$_POST['emailC'].'"';
    $resultat  = mysqli_query($lien , $id);
    $idC = mysqli_fetch_array($resultat);
   
      $sql = 'INSERT INTO equipe(Nom,ChefID,BotanisteID) VALUES("'.$Nom.'" , '.$idC['PersonneID'].','.$idB['PersonneID'].')';
      mysqli_query($lien, $sql) or die(mysqli_error($lien));
   }
?>