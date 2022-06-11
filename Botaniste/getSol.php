<?php
//setting header to json
header('Content-Type: application/json');

//database
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'pfe');
$idPlante = $_GET['idPlante'];
//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(!$mysqli){
  die("Connection failed: " . $mysqli->error);
}

if (isset($_GET['date'])) {
  $date = $_GET['date'];
  $query = sprintf('SELECT Date, HumiditeSol FROM mesure 
 where PlanteID='.$idPlante.' and date like "'.$date.'" ');
}else{
$query = sprintf('SELECT Date, HumiditeSol FROM mesure 
 where PlanteID='.$idPlante.' ');
}

//query to get data from the table


//execute query
$result = $mysqli->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
  $data[] = $row;
}

//free memory associated with result
$result->close();

//close connection
$mysqli->close();

//now print the data
print json_encode($data);
?>