<?php

use function PHPSTORM_META\type;

require '../config.php';
session_start();
$user = $_GET['hide'];
$ingredients = [];
$imgUrl = $_GET['img_url'];
$title = $_GET['title'];
$desc = $_GET['desc'];
$veg = $_GET['is_veg'];
$num = $_GET['numIng'];

$sql = "INSERT INTO post(img_url, title, published_at, is_veg, caption, user_id)
        VALUES ('Users/test/images/$imgUrl', '$title', now(), $veg, '$desc', '$user')";

if (!isset($ingredients[0])) {
    $_SESSION['empty'] = true;
    header("Location: ../addPost.php");
}

try {
    $ret = mysqli_query($conn, $sql);
    $sql = "SELECT * FROM post ORDER BY published_at DESC LIMIT 1";
    $ret = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($ret);
    $num = $row['pid'];

    foreach ($ingredients as $i) {
        $sql = "INSERT INTO postingredient(ingredient_name, post_id)
                VALUES ('$i', $num)";

        try {
            $ret2 = mysqli_query($conn, $sql);
        } catch (Exception $e) {
            
                }
    }

    $followersSql = "SELECT follower_id FROM follower WHERE following_id = '$user'";
    $followersResult = mysqli_query($conn, $followersSql);

    while ($followerRow = mysqli_fetch_assoc($followersResult)) {
        $followerId = $followerRow['follower_id'];

        $notificationMessage = "New post from $user: $title";
        $notificationSql = "INSERT INTO notification(user_id, message, timestamp, seen)
                            VALUES ('$followerId', '$notificationMessage', now(), 0)";

        mysqli_query($conn, $notificationSql);
    }

    $_SESSION['succ'] = true;
    header("Location: ../addPost.php");
} catch (Exception $e) {
}

// mysqli_free_result($ret);
$conn->close();
?>
