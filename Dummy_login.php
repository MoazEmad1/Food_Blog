<?php
session_start();
include 'config.php';
include 'styleTemp.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $admin_sql = "SELECT * FROM admin WHERE user_name = '$username' AND pass = '$password'";
    $admin_result = $conn->query($admin_sql);

    if ($admin_result->num_rows == 1) {
        $admin = $admin_result->fetch_assoc();
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_id'] = $admin['adminid'];
        $_SESSION['admin_username'] = $admin['user_name'];

        header("Location: admin_panel.php");
        exit();
    }

    // Check if the user is a regular user
    $user_sql = "SELECT * FROM page_user WHERE user_name = '$username' AND pass = '$password'";
    $user_result = $conn->query($user_sql);

    if ($user_result->num_rows == 1) {
        $user = $user_result->fetch_assoc();
        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = $user['uid'];
        $_SESSION['username'] = $user['user_name'];
        $_SESSION['first_name'] = $user['first_name'];

        header("Location: hompage.php");
        exit();
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Add your styles and scripts here -->
</head>
<body>
    <div class="container">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h2>Login</h2>
            <?php if (isset($error)) { ?>
                <p class="error"><?php echo $error; ?></p>
            <?php } ?>
            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
