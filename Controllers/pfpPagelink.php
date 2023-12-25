<?php
session_start();
$_SESSION['link'] = $_GET['user_id'];
header('Location: ../profile.php');
?>