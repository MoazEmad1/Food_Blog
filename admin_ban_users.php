<?php
error_reporting(E_ALL ^ E_NOTICE); 
session_start();
include 'config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: Dummy_login.php");
    exit();
}

require 'includes_and_requires/bootstrap.php';
require 'styleTemp.php';

// Unban selected users
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["unban_users"])) {
    $selectedUsers = $_POST["user_ids"];

    foreach ($selectedUsers as $userId) {
        // Check if the user is banned
        $check_ban_sql = "SELECT COUNT(*) as count FROM ban_table WHERE uid = '$userId'";
        $result = mysqli_query($conn, $check_ban_sql);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $banCount = $row['count'];

            // If the user is banned, unban them
            if ($banCount > 0) {
                $unban_sql = "DELETE FROM ban_table WHERE uid = '$userId'";
                mysqli_query($conn, $unban_sql);
            }
        }
    }

    header("Location: admin_ban_users.php");
    exit();
}

// Fetch the list of banned users
$sql = "SELECT * FROM page_user WHERE uid IN (SELECT uid FROM ban_table)";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $bannedUsers = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $bannedUsers = [];
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unban Users</title>
</head>
<body>
    <?php include 'includes_and_requires/menu.php'; ?>
    <div class="container mt-5">
        <h2>Unban Users</h2>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <table class="table">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Unban</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bannedUsers as $user) : ?>
                        <tr>
                            <td><?php echo $user['uid']; ?></td>
                            <td><?php echo $user['user_name']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td>
                                <label>
                                    <input type="checkbox" name="user_ids[]" value="<?php echo $user['uid']; ?>"> Unban User
                                </label>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <button type="submit" name="unban_users" class="btn btn-success">Unban Selected Users</button>
        </form>

    </div>
</body>
</html>
