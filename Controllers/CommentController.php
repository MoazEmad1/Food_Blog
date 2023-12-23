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
if($_SESSION['loc']=='home'){
    $loc = "../hompage.php";
}else if ($_SESSION['loc']=='user'){
    $loc = "../userPage.php";
}
//empty comment validation
if($comment == ""){
    $_SESSION['failed']=true;
    header("Location: $loc");
}else{
    try{
        $ret = mysqli_query($conn,$sql);
        unset($_SESSION['user']);
        unset($_SESSION['post']);
        $_SESSION['succ'] = true;
        header("Location: $loc");
    }catch(Exception $e){
        $_SESSION['failed']=true;
        header("Location: $loc");
    }
}
$conn->close();
?>