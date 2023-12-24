<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) && !isset($_SESSION['admin_id'])) {
    header("Location: Dummy_login.php");
    exit();
}
// error_reporting(E_ALL);
//     ini_set('display_errors', 1);
require 'includes_and_requires/bootstrap.php';
require 'styleTemp.php';

$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : $_SESSION['user_id'];

$sql = "SELECT * FROM page_user WHERE uid = $user_id";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    die("User not found");
}

if (isset($_POST['ban_user'])) {
    $ban_user_id = $_POST['ban_user_id'];
    
    $check_ban_sql = "SELECT COUNT(*) as count FROM ban_table WHERE uid = '$ban_user_id'";
    $check_result = mysqli_query($conn, $check_ban_sql);
    
    if ($check_result) {
        $row = mysqli_fetch_assoc($check_result);
        $banCount = $row['count'];
        
        if ($banCount == 0) {
            $ban_sql = "INSERT INTO ban_table (uid, admin_id, banned_at) VALUES ('$ban_user_id', '{$_SESSION['admin_id']}', NOW())";
            $ban_result = mysqli_query($conn, $ban_sql);

            if ($ban_result) {
                echo "User with ID $ban_user_id has been banned!";
            } else {
                echo "Error banning user with ID $ban_user_id: " . mysqli_error($conn);
            }
        } else {
            echo "User with ID $ban_user_id is already banned!";
        }
    } else {
        echo "Error checking ban status: " . mysqli_error($conn);
    }
}


mysqli_free_result($result);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - <?php echo $user['first_name'] . ' ' . $user['last_name']; ?></title>
    <?php require 'includes_and_requires/bootstrap.php'; ?>
    <?php require 'styleTemp.php'; ?>
</head>

<body>
    <?php include 'includes_and_requires/menu.php'; ?>

    <div class="container mt-5">
        <h2>Profile: <?php echo $user['first_name'] . ' ' . $user['last_name']; ?></h2>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    <?php echo $user['first_name'] . ' ' . $user['last_name']; ?>
                </h5>
                <p class="card-text">Email: <?php echo $user['email']; ?></p>
                <!-- Add more user details as needed -->

                <!-- You can also add links to edit profile, change password, etc. -->
                <?php if ($_SESSION['user_id'] == $user['uid'] || isset($_SESSION['admin_id'])) : ?>
                    <a href="edit_profile.php?user_id=<?php echo $user['uid']; ?>">Edit Profile</a>
                    <a href="change_password.php">Change Password</a>
                <?php endif; ?>

                <?php if (isset($_SESSION['admin_id']) && $_SESSION['admin_id'] == 1) : ?>
                    <form action="" method="post">
                        <input type="hidden" name="ban_user_id" value="<?php echo $user['uid']; ?>">
                        <button type="submit" name="ban_user" class="btn btn-danger">Ban User</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>
