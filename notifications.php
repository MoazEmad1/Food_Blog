<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: Dummy_login.php");
    exit();
}

$userId = $_SESSION['user_id'];
$sql = "SELECT * FROM notification WHERE user_id = $userId ORDER BY timestamp DESC";
$result = mysqli_query($conn, $sql);

$sqlMarkSeen = "UPDATE notification SET seen = 1 WHERE user_id = $userId";
mysqli_query($conn, $sqlMarkSeen);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <?php require 'includes_and_requires/bootstrap.php' ?>
    <?php require 'styleTemp.php' ?>
</head>

<body>
    <?php include 'includes_and_requires/menu.php' ;
    error_reporting(E_ALL);
    ini_set('display_errors', 1);?>

    <div class="container mt-4">
        <h2>Notifications</h2>
        <ul class="list-group">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                $notificationMessage = $row['message'];
                $createdAt = $row['timestamp'];
                $seen = $row['seen'];


            

                $style = $seen ? 'list-group-item-light' : 'list-group-item-dark';

                echo "<li class='list-group-item $style'>$notificationMessage - $createdAt</li>";
            }
            ?>
        </ul>
    </div>

</body>

</html>

<?php
mysqli_free_result($result);
mysqli_close($conn);
?>
