<?php
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>


<?php
session_start();
require '../config2.php';
$user = $_SESSION['user'];
$post = $_SESSION['post'];
$comment = test_input($_SESSION['comment']);
$sql = "
insert into post_comment(uid,pid,commented_at,content)
values ($user,$post,now(),'$comment');
";

//empty comment validation
if($comment = " "){
    $_SESSION['failed']=true;
    header("Location: ../hompage.php");
}
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