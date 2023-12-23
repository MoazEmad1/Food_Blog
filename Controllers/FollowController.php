<?php
session_start();
require '../config2.php';
if($_GET['choice']=='follow'){
    $sql = "INSERT INTO follower (follower_id,following_id)
    values($_SESSION[user_id],$_SESSION[pageUser])";
}else if($_GET['choice']=='unfollow'){
    $sql = "Delete from follower where follower_id = $_SESSION[user_id] and following_id = $_SESSION[pageUser]";
}
$_SESSION['follower']=true;
try{
    $ret = mysqli_query($conn,$sql);
    $_SESSION['succ'] = true;
    header("Location: ../userPage.php");
}catch(Exception $e){
    $_SESSION['failed']=true;
    header("Location: ../userPage.php");
}
$conn->close();
?>