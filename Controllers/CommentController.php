<?php
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<?php
session_start();
require '../config.php';
$user = $_SESSION['user'];
$post = $_SESSION['post'];
$comment = test_input($_SESSION['comment']);

$sqlNotification = "
    INSERT INTO notifications (user_id, post_id, notification_type, created_at)
    VALUES (
        (SELECT user_id FROM post WHERE pid = $post),
        $post,
        'comment',
        NOW()
    )
";

$sqlComment = "
    INSERT INTO post_comment (uid, pid, commented_at, content)
    VALUES ($user, $post, NOW(), '$comment')
";

if ($_SESSION['loc'] == 'home') {
    $loc = "../homepage.php";
} elseif ($_SESSION['loc'] == 'user') {
    $loc = "../profile.php";
}

if ($comment == "") {
    $_SESSION['failed'] = true;
    header("Location: $loc");
} else {
    try {
        $retComment = mysqli_query($conn, $sqlComment);

        $retNotification = mysqli_query($conn, $sqlNotification);

        if ($retComment && $retNotification) {
            unset($_SESSION['user']);
            unset($_SESSION['post']);
            $_SESSION['succ'] = true;
            header("Location: $loc");
        } else {
            $_SESSION['failed'] = true;
            header("Location: $loc");
        }
    } catch (Exception $e) {
        $_SESSION['failed'] = true;
        header("Location: $loc");
    }
}

$conn->close();
?>
