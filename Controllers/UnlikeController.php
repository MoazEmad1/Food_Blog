<?php
session_start();
require '../config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
$sql = "DELETE FROM post_like WHERE uid = {$_SESSION['user']} AND pid = {$_SESSION['post']}";
$loc = "error.php";

if ($_SESSION['loc'] == 'home') {
    $loc = "../hompage.php";
} else if ($_SESSION['loc'] == 'user') {
    $loc = "../profile.php";
}


try {
    $ret = mysqli_query($conn, $sql);

    if ($ret === false) {
        throw new Exception("Error deleting like");
    }

    unset($_SESSION['user']);
    unset($_SESSION['post']);
    $_SESSION['succ'] = true;
    header("Location: $loc");
    exit(); 
} catch (Exception $e) {
    $_SESSION['failed'] = true;
    echo $e;
    header("Location: $loc");
    exit(); 
}

$conn->close();
?>
