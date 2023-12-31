<?php
session_start();
require '../config.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$sender = $_GET['sender'];
$receiver = $_GET['receiver'];
$message = mysqli_real_escape_string($conn, $_GET['mes']);

$getSenderNameSql = "SELECT user_name FROM page_user WHERE uid = $sender";
$getSenderNameResult = mysqli_query($conn, $getSenderNameSql);

$getReceiverNameSql = "SELECT user_name FROM page_user WHERE uid = $receiver";
$getReceiverNameResult = mysqli_query($conn, $getReceiverNameSql);

if ($getSenderNameResult && $getReceiverNameResult) {
    $senderNameRow = mysqli_fetch_assoc($getSenderNameResult);
    $receiverNameRow = mysqli_fetch_assoc($getReceiverNameResult);

    $senderName = $senderNameRow['user_name'];
    $receiverName = $receiverNameRow['user_name'];

    $loc = "../messages.php";
    $sql = "
        INSERT INTO message(personA, personB, mesageContent, sent_at) 
        VALUES($sender, $receiver, '$message', now());
    ";
    
    try {
        $ret = mysqli_query($conn, $sql);

        if (!$ret) {
            throw new Exception(mysqli_error($conn));
        }

        $notificationMessage = "$senderName sent you a message!";
        $notificationSql = "
            INSERT INTO notification(user_id, message, timestamp, seen)
            VALUES ('$receiver', '$notificationMessage', now(), 0)
        ";

        mysqli_query($conn, $notificationSql);

        $_SESSION['succ'] = true;
        echo "Message sent successfully!";
        header("Location: $loc");
    } catch (Exception $e) {
        $_SESSION['failed'] = true;
        echo "Error: $e";
        header("Location: $loc");
    }
} else {
    $_SESSION['failed'] = true;
    header("Location: error.php");
}

$conn->close();
?>
