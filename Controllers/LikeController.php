<?php
session_start();
require '../config.php';

$postId = $_SESSION['post'];
$userId = $_SESSION['user'];

$getPostOwnerSql = "SELECT user_id FROM post WHERE pid = $postId";
$getPostOwnerResult = mysqli_query($conn, $getPostOwnerSql);

if ($getPostOwnerResult && $row = mysqli_fetch_assoc($getPostOwnerResult)) {
    $postOwnerId = $row['user_id'];

    $getUserNameSql = "SELECT user_name FROM page_user WHERE uid = $userId";
    $getUserNameResult = mysqli_query($conn, $getUserNameSql);

    if ($getUserNameResult && $userNameRow = mysqli_fetch_assoc($getUserNameResult)) {
        $userName = $userNameRow['user_name'];

        $sql = "INSERT INTO post_like(uid, pid, liked_at)
                VALUES ($userId, $postId, now())";

        $loc = "error.php";

        if ($_SESSION['loc'] == 'home') {
            $loc = "../hompage.php";
        } else if ($_SESSION['loc'] == 'user') {
            $loc = "../profile.php";
        }

        try {
            $ret = mysqli_query($conn, $sql);

            $notificationMessage = "$userName liked your post!";
            $notificationSql = "INSERT INTO notification(user_id, message, timestamp, seen)
                                VALUES ('$postOwnerId', '$notificationMessage', now(), 0)";

            mysqli_query($conn, $notificationSql);

            unset($_SESSION['user']);
            unset($_SESSION['post']);
            $_SESSION['succ'] = true;
            header("Location: $loc");
        } catch (Exception $e) {
            $_SESSION['failed'] = true;
            echo "$e";
            header("Location: $loc");
        }
    } else {
        $_SESSION['failed'] = true;
        header("Location: error.php");
    }
} else {
    $_SESSION['failed'] = true;
    header("Location: error.php");
}

$conn->close();
?>
