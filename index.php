<style>
* {
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Poppins', sans-serif;
}


header {
    height: 100vh;
    -webkit-background-size: cover;
    background-size: cover;
    background-position: center center;
    position: relative;
}

.nav-area {
    float: right;
    list-style: none;
    margin-top: 30px;
}

.nav-area li {
    display: inline-block;
}

.nav-area li a {
    color: #fff;
    text-decoration: none;
    padding: 5px 20px;
    font-family: poppins;
    font-size: 16px;
    text-transform: uppercase;
}

.nav-area li a:hover {
    background: #0c8195;
    color: #333;
}

.logo {
    float: left;
}

.logo img {
    width: 100%;
    padding: 15px 0;
}

.welcome-text {
    background-image: url(https://cdn.pixabay.com/photo/2013/07/12/19/24/sapling-154734_960_720.png), linear-gradient(#0d7c8f, #ffffff);
    width: 100%;
    background-repeat: no-repeat;
    background-position: center;

    justify-content: center;
    align-items: center;
    display: flex;
    flex-direction: column;
    height: 88%;
    text-align: center;
}

.welcome-text h1 {
    text-align: center;
    color: #fff;
    text-transform: uppercase;
    justify-content: center;
    font-size: 60px;
}

.welcome-text h1 span {
    color: #0c8195;
}

.welcome-text a {
    border: 2px solid #fff;
    padding: 10px 25px;
    text-decoration: none;
    text-transform: uppercase;
    font-size: 14px;
    margin-top: 20px;
    display: inline-block;
    color: #fff;
    font-weight: bolder;
}

.welcome-text a:hover {
    background: #fff;
    color: #0c8195;
}
</style>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Homepage</title>
    <link rel="stylesheet" href="styles/shop.css">

</head>

<body>
    <header>
        <div class="wrapper">
            <?php
            include "components/navbar.php";
            ?>
        </div>
        <div class="welcome-text">
            <h1 class="title">
                Plant <span>Speak</span></h1>
            <a href="authenticate.php">Se connecter</a>
        </div>
    </header>
    <div>
        <img src="" alt="">
        <div>

        </div>
    </div>

</body>

</html>