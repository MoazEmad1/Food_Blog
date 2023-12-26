<?php
error_reporting(E_ALL ^ E_NOTICE); 
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) && !isset($_SESSION['admin_id'])) {
    header("Location: Dummy_login.php");
    exit();
}
if(($_SESSION['user_id']!=$_GET['user_id'])&&!isset($_SESSION['admin_id'])){
    header("Location: no_access.php");
    exit();
}

require 'includes_and_requires/bootstrap.php';
require 'styleTemp.php';

$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : $_SESSION['user_id'];

// Fetch user details from the database
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

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_profile'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Update user details in the database
    $update_sql = "UPDATE page_user SET user_name = '$username', first_name = '$first_name', 
                   last_name = '$last_name', email = '$email', pass = '$password' 
                   WHERE uid = $user_id";

    $update_result = mysqli_query($conn, $update_sql);

    if ($update_result) {
        echo "Profile updated successfully!";
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
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
    <title>Edit Profile - <?php echo $user['first_name'] . ' ' . $user['last_name']; ?></title>
    <?php require 'includes_and_requires/bootstrap.php'; ?>
    <?php require 'styleTemp.php'; ?>
</head>

<body>
    <?php include 'includes_and_requires/menu.php'; ?>

    <div class="container mt-5">
        <h2>Edit Profile: <?php echo $user['first_name'] . ' ' . $user['last_name']; ?></h2>

        <form method="post" action="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['user_name']; ?>">
            </div>

            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $user['first_name']; ?>">
            </div>

            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $user['last_name']; ?>">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>">
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <button type="submit" name="update_profile" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
</body>

</html>
