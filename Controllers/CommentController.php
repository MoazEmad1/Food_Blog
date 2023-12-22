<?php
session_start();
require '../config2.php';
$user = $_SESSION['user'];
$post = $_SESSION['post'];
$comment = $_SESSION['comment'];
$sql = "
insert into post_comment(uid,pid,commented_at,content)
values ($user,$post,now(),'$comment');
";
try{
    $ret = mysqli_query($conn,$sql);
    unset($_SESSION['user']);
    unset($_SESSION['post']);
    $_SESSION['succ'] = true;
    header("Location: ../hompage.php");
}catch(Exception $e){
    $_SESSION['failed']=true;
    echo "$e";
    //header("Location: ../hompage.php");
}
$conn->close();
?>