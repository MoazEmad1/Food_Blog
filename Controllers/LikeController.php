<?php
session_start();
require '../config2.php';
$sql = "insert into post_like(uid,pid,liked_at)
values($_SESSION[user],$_SESSION[post],now())";
try{
    $ret = mysqli_query($conn,$sql);
    unset($_SESSION['user']);
    unset($_SESSION['post']);
    $_SESSION['succ'] = true;
    header("Location: ../hompage.php");
}catch(Exception $e){
    $_SESSION['failed']=true;
    header("Location: ../hompage.php");
}
$conn->close();
?>