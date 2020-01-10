<?php

$servername = "localhost";
$username = "root";
$password = "";
$connname = "mcq_quiz";
$errors = array();
 
$conn = new mysqli($servername, $username, $password, $connname);
//include("basicAuth.php");
header('Access-Control-Allow-Origin: *'); 
    header("Access-Control-Allow-Credentials: true");
    header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
    header('Access-Control-Max-Age: 1000');
    header('Access-Control-Allow-Headers: *');

if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>