<link rel="stylesheet" href="auth.css">
<link rel="stylesheet" href="styles/shop.css">
<h2>Se connecter</h2>
<div class="container" id="container">
    <div class="form-container sign-in-container">
        <form action="authenticate.php" method="POST">
            <h1>Se connecter</h1>
            <input type="email" name="email" placeholder="Email" />
            <input type="password" name="password" placeholder="Password" />
            <input type="submit" value="Se connecter" />
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-right">
                <h1>Bienvenue !</h1>
                <p>Entrez vos données personnelles et commencez votre voyage avec nous</p>
            </div>
        </div>
    </div>
</div>
<script src="scripts/js-snackbar.js"></script>
<link rel="stylesheet" href="styles/js-snackbar.css">

<?php
    session_start();

if (isset($_POST['email']) and isset($_POST['password'])) {
        $psd=$_POST['password'];
        $email = $_POST['email'];
        $lien = mysqli_connect('localhost','root','','pfe');
        $sql = 'select * from personne where Email="'.$email.'" and MotDePasse="'.$psd.'"';
        $result = mysqli_query($lien , $sql);
        if(mysqli_num_rows($result) == 0){
            echo "	<script>
            new SnackBar({
                  message: 'invalid information',
                  position: 'bl',
                  fixed:true,
               });

            </script>
";
            exit();
        }
        
        var_dump($result);
        $linge = mysqli_fetch_array($result);
        $_SESSION["nom"]= $linge['Nom'];
            $_SESSION["prenom"]=$linge['Prenom'];
            $_SESSION['img']= $linge['img'];
            $_SESSION['id'] = $linge['PersonneID'];
        $id = $linge['PersonneID'];
        echo $id;
        $sql = 'select * from botaniste where BotanisteID ='.$id.'';
        $result2 = mysqli_query($lien,$sql);
        if (mysqli_num_rows($result2)) {
            $_SESSION["botaniste"] = "true";
            
            header('location: Botaniste/');
        }
        $sql = 'select * from chefequipe where ChefID = '.$id.'';
        $result2 = mysqli_query($lien , $sql);
        if (mysqli_num_rows($result2)) {
            $_SESSION["chef"] = "true";
            
            header('location: chefEquipe/');
        }
        $sql = 'select * from responsable where ResponsableID = '.$id.'';
        $result2 = mysqli_query($lien , $sql);
        if (mysqli_num_rows($result2)) {
            $_SESSION["responsable"] = "true";
            
            header('location: chefLabo/');
        }
        
    }
?>