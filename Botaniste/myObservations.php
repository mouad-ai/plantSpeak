<style>
.observations {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    padding-top: 20px;

}

.paginationContainer {
    display: flex;
    justify-content: center;
    gap: 10px;

}

.paginationContainer a.active {
    background-color: #4CAF50;
    color: white;
}

.pagination {
    justify-content: center;
    text-align: center;
    font-size: large;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    padding: 0 6px;
    border-radius: 5px;
}
</style>

<body>
    <link rel="stylesheet" href="../styles/shop.css">

    <?php
include('sideBar.php');

?>
    <div class="observations">
        <?php
    include('observationCard.php');
     $lien = mysqli_connect('localhost' ,'root','','pfe');
     $idBotaniste = $_SESSION['id'];
    
    $ssql = 'SELECT * FROM observation INNER JOIN plante ON observation.PlanteID = plante.PlanteID WHERE observation.PersonneID = "'.$idBotaniste.'";';

    $results_per_page = 5;  
  
    //find the total number of results stored in the database  
    
    $result = mysqli_query($lien, $ssql);  
    $number_of_result = mysqli_num_rows($result);  
  
    //determine the total number of pages available  
    $number_of_page = ceil ($number_of_result / $results_per_page);  
  
    //determine which page number visitor is currently on  
    if (!isset ($_GET['page']) ) {  
        $page = 1;  
    } else {  
        $page = $_GET['page'];  
    }  
  
    //determine the sql LIMIT starting number for the results on the displaying page  
    $page_first_result = ($page-1) * $results_per_page;  
  
    //retrieve the selected results from database   
    $query = 'SELECT * FROM observation INNER JOIN plante ON observation.PlanteID = plante.PlanteID WHERE observation.PersonneID = "'.$idBotaniste.'" LIMIT '. $page_first_result . ',' . $results_per_page;  
    $result = mysqli_query($lien, $query);  
      
    //display the retrieved result on the webpage  
    while ($row = mysqli_fetch_array($result)) {  
        
        echo observationCard($row['Nom'],$row['Contenu'], $row['Date']);

    }  
  
  
    //display the link of the pages in URL  
    


    
    
  
    ?>
    </div>
    <div class="paginationContainer">


        <?php 
    for($page = 1; $page<= $number_of_page; $page++) {  
        echo '<a class="pagination '.$page.'" href = "myObservations.php?page=' . $page . '">' . $page . ' </a>';  
    }  
    ?>
    </div>
</body>
<script>
var body = document.body,
    html = document.documentElement;

var height = Math.max(body.scrollHeight, body.offsetHeight,
    html.clientHeight, html.scrollHeight, html.offsetHeight);
document.querySelector('.menu').style.height = height;


const params = new URLSearchParams(window.location.search)
if (params.has('page')) {
    document.getElementsByClassName(params.get('page'))[0].style.backgroundColor = "#0b7486";
    document.getElementsByClassName(params.get('page'))[0].style.color = "white";
} else {
    document.getElementsByClassName(1)[0].style.backgroundColor = "#0b7486"
    document.getElementsByClassName(1)[0].style.color = "white"


}
</script>
<?php


 
  
  
?>