<?php
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname) or die("Connection failed to DB");

?>