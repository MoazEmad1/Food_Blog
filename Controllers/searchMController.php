<?php
session_start();
require '../config.php';
$username = $_GET['user_name'];
$loc = "error.php";
$sql = "
    select uid from 
";
try{
    $ret = mysqli_query($conn,$sql);
    $_SESSION['succ'] = true;
    header("Location: $loc");
}catch(Exception $e){
    $_SESSION['failed']=true;
    echo"$e";
    header("Location: $loc");
}
$conn->close();
?>