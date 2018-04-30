<?php

session_start();
require_once '../dbconnect.php';

if(!isset($_SESSION['userSession'])) {
   include_once("logout.php");
   exit;
}

$user_id = $_SESSION["userSession"] ;

$query = $DBcon->query("SELECT * FROM user where user_id= '$user_id'");
$userRow=$query->fetch_array();


//query to get data from the table
$query = sprintf("SELECT date, deposit, withdraw, balance FROM branch where states='Close'");

//execute query
$result = $DBcon->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

//free memory associated with result
$result->close();

//close connection
$DBcon->close();

//now print the data
print json_encode($data);
