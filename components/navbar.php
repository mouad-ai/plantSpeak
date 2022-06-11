<style>
.navbar,
nav {
    background-color: #0c8195;
    width: 100%;
}
</style>
<?php
if (session_status() === PHP_SESSION_NONE) {
   session_start();
}
$UriSegment = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$lastUriSegment = array_pop($UriSegment);
?>
<div class="navbar">
    <nav>
        <input type="checkbox" id="show-search">
        <input type="checkbox" id="show-menu">
        <label for="show-menu" class="menu-icon"><i class="fas fa-bars"></i></label>
        <div class="navbar-content">
            <div class="logo"><a href="./">PlantSpeak</a></div>
            <ul class="links">
                <li><a href="./">Home</a></li>
                <li><a href="#">Qui sommes-nous</a></li>

                <li><a href="#">Contactez-nous</a></li>
                <li><a href="./authenticate.php">Se connecter</a></li>


            </ul>
        </div>
        <label for="show-search" class="search-icon"><i class="fas fa-search"></i></label>
        <form action="/shop/shop.php" method="GET" class="search-box">
            <input type="text" placeholder="Tapez quelque chose à rechercher..." required name="q">
            <button type="submit" class="go-icon"><i class="fas fa-long-arrow-alt-right"></i></button>
        </form>
    </nav>
</div>