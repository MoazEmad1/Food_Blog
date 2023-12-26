<?php
session_start();
require '../config.php';
$username = $_GET['user_name'];
$loc = "error.php";
$sql = "
    select uid 
    from page_user 
    where user_name = '$username' and uid != $_SESSION[user_id]
";
try{
    echo $username;
    $ret = mysqli_query($conn,$sql);
    $_SESSION['succ'] = true;
    echo"done";
    if(mysqli_num_rows($ret)==0){
        $loc = "../searchMessages.php";
        header("Location: $loc");
    }
    $row = mysqli_fetch_assoc($ret);
    $_SESSION['receiver'] = $row['uid'];
    $loc = "../messages.php";
    header("Location: $loc");
}catch(Exception $e){
    $_SESSION['failed']=true;
    echo"$e";
    header("Location: $loc");
}
$conn->close();
?>