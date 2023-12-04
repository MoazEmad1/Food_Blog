<?php
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "db1";

$conn = new mysqli($servername, $username, $password, $dbname) or die("Connection failed to DB");

?>