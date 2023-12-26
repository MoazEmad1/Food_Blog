<?php
session_start();
require '../config.php';
$sender = $_GET['sender'];
$receiver = $_GET['receiver'];
$message = $_GET['mes'];
$loc = "../messages.php";
$sql = "
    insert into message(personA,personB,mesageContent,sent_at) 
    values($sender,$receiver,'$message',now());
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