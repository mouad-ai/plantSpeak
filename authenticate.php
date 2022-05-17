<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/authenticate.css">
    <title>authenticate</title>
</head>

<body>
    <?php
   ?>
    <div class="wrapper">
        <div class="title-text">
            <div class="title login">Se connecter</div>
            <div class="title signup"> &nbsp Créer un compte</div>
        </div>
        <div class="form-container">
            <div class="slide-controls">
                <input type="radio" name="slide" id="login" checked>
                <input type="radio" name="slide" id="signup">
                <label for="login" class="slide login">Se connecter
                </label>
                <label for="signup" class="slide signup">Créer</label>
                <div class="slider-tab"></div>
            </div>
            <div class="form-inner">
                <form action="acces.php" class="login" method="POST">
                    <div class="field">
                        <input type="text" placeholder="Email Address" name="email" required>
                    </div>
                    <div class="field">
                        <input type="password" placeholder="Password" name="password" required>
                    </div>
                    <div class="pass-link forgot"><a href="#">Mot de passe oublié ?</a></div>
                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" value="Login">
                    </div>
                    <?php if(isset($_GET['error'])) echo '<div style="color:red;text-align:center;margin-top:5px;text-transform:capitalize;">wrong credentials ! </div>'?>
                    <div class="signup-link">
                        NOUVEAU SUR TECHRABAT ? <a href="">Créer un compte</a></div>
                </form>
                <form action="acces.php" class="signup" method="POST">
                    <div class="field">
                        <input type="text" placeholder="Email Address" name="email" required>
                    </div>
                    <div class="field">
                        <input type="password" placeholder="Password" name="password" required>
                    </div>
                    <div class="field">
                        <input type="text" placeholder="Prenom" name="name" required>
                    </div>
                    <div class="field">
                        <input type="text" placeholder="Adresse" name="adresse" required>
                    </div>
                    <div class="field">
                        <input type="text" placeholder="Numero De Telephone" name="phone" required>
                    </div>
                    <div class="field">
                        <input type="text" placeholder="Ville" name="ville" required>
                    </div>
                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" value="Signup">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="scripts/authenticate.js"></script>
</body>

</html>