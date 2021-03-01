<?php
header('Access-Control-Allow-Methods: GET');
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$connection = mysqli_connect("localhost", "root", "") or trigger_error(mysqli_error(), E_USER_ERROR);

if (isset($_GET['term'])) {
    
	$q = $_GET['term'];
    
    mysqli_select_db($connection, "models");
    $query = "SELECT DISTINCT model FROM model
        WHERE model LIKE '%{$q}%'
        ORDER BY model ASC LIMIT 15";
    
    $something = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $totalRows_rows = mysqli_num_rows($something);
    
    $models = array();
    while ($row_something = mysqli_fetch_assoc($something)) {
        
        $models[] = $row_something['model'];
    }
}
echo json_encode($models);
exit;
?>