<?php
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname) or die("Connection failed to DB");

if($conn->connect_error){
    die("Connection_failed ".$conn->connect_error);
}
?>