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
            <div class="logo"><a href="shop.php">TechRabat</a></div>
            <ul class="links">
                <li><a href="/shop/shop.php">Boutique</a></li>
                <li><a href="#">Qui sommes-nous</a></li>
                <?php
            if ($lastUriSegment != 'panier.php') {
               echo '<li><a href="/shop/panier.php">Panier</a></li>';
            }
            ?>
                <li><a href="#">Contactez-nous</a></li>
                <?php
            if (isset($_SESSION['email'])) {
               echo '<li><a href="/shop/disconnect.php">Se Deconnecter</a></li>';
            } else {
               echo '<li><a href="/shop/authenticate.php">S\'identifier</a></li>';
            }
            ?>
                <?php
            if (isset($_SESSION['isAdmin']) and $_SESSION['isAdmin']=="1") {
               echo '<li>
               <a href="#" class="desktop-link">Admin</a>
               <input type="checkbox" id="show-admin">
               <label for="show-admin">Admin</label>
               <ul>
                  <li><a href="/shop/admin/product">Manage Product</a></li>
                  <li><a href="/shop/admin/user">Manage User</a></li>
               </ul>
               </li>';
               // echo '<li><a href="/shop/admin">Admin</a></li>';
            }
            ?>

            </ul>
        </div>
        <label for="show-search" class="search-icon"><i class="fas fa-search"></i></label>
        <form action="/shop/shop.php" method="GET" class="search-box">
            <input type="text" placeholder="Type Something to Search..." required name="q">
            <button type="submit" class="go-icon"><i class="fas fa-long-arrow-alt-right"></i></button>
        </form>
    </nav>
</div>