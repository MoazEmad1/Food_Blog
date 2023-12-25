<?php
error_reporting(E_ALL ^ E_NOTICE); 
session_start();
include 'config.php';
if (!isset($_SESSION['admin_id'])) {
    header("Location: Dummy_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <?php require 'includes_and_requires/bootstrap.php'; ?>
    <?php require 'styleTemp.php'; ?>
</head>
<body>
    <?php include 'includes_and_requires/menu.php'; ?>
    <div class="container mt-5">
        <h2>Welcome to the Admin Panel</h2>
        <!-- Add admin-specific content here -->
        <div class="admin-functionalities">
                <h3>Admin Functionalities:</h3>
                <ul>
                    <li><a href="admin_ban_users.php">Manage Users</a></li>
                    <li><a href="admin_manage_items.php">Manage Items</a></li>
                    <!-- Add more admin functionalities as needed -->
                </ul>
            </div>
        

    </div>
</body>
</html>
