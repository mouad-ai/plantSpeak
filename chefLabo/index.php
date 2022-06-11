<link rel="stylesheet" href="sideBar.css">
<link rel="stylesheet" href="../styles/shop.css">
<style>
.helper {
    text-align: center;

}

.bonjour {
    padding: 24px;
    margin-top: 20px;
    line-height: 100px;
    border: 3px solid white;
    border-radius: 10px;
    text-transform: uppercase;
    background-color: #0c8195;
    color: white;
    font-weight: bolder;
}


.info {
    display: flex;
    margin-top: 40px;
    justify-content: space-around;
    text-align: center;
    align-items: center;
    gap: 45px;
    flex-wrap: wrap;

}

.info img {
    justify-content: center;
}

h1 {}
</style>
<?php
    include('sideBar.php');
?>

<main style="width:100% ;">
    <div class="helper">

        <span class="bonjour">
            BIENVENUE dans la page Admin

        </span>
    </div>
    <div class="info">





    </div>
</main>
<script>
var body = document.body,
    html = document.documentElement;

var height = Math.max(body.scrollHeight, body.offsetHeight,
    html.clientHeight, html.scrollHeight, html.offsetHeight);
document.querySelector('.menu').style.height = height
</script>