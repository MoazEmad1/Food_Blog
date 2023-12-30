<?php
session_start();
require '../config.php';

if ($_GET['choice'] == 'follow') {
    $sql = "INSERT INTO follower (follower_id, following_id)
    VALUES ($_SESSION[user_id], $_SESSION[pageUser])";

    $sqlNotification = "
        INSERT INTO notifications (user_id, notification_type, created_at)
        VALUES ($_SESSION[pageUser], 'follow', NOW())
    ";
} else if ($_GET['choice'] == 'unfollow') {
    $sql = "DELETE FROM follower WHERE follower_id = $_SESSION[user_id] AND following_id = $_SESSION[pageUser]";
}

$_SESSION['follower'] = true;

try {
    $ret = mysqli_query($conn, $sql);

    if ($_GET['choice'] == 'follow') {
        $retNotification = mysqli_query($conn, $sqlNotification);
    }

    $_SESSION['succ'] = true;
    header("Location: ../profile.php");
} catch (Exception $e) {
    $_SESSION['failed'] = true;
    header("Location: ../profile.php");
}
$conn->close();
?>
