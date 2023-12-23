<?php
session_start();
//error_reporting(E_ERROR | E_PARSE);
$_SESSION['user'] = $_GET['user'];
$_SESSION['post'] = $_GET['post'];
$_SESSION['loc'] = $_GET['loc'];
echo"$_GET[comment]";
if ($_GET['like']!=NULL){
    $_SESSION['like']=$_GET['like'];
    header('Location: LikeController.php');
}else if($_GET['comm']!=NULL){
    $_SESSION['comment']=$_GET['comment'];
    header("Location: CommentController.php");
}
?>