<?php
error_reporting(E_ALL ^ E_NOTICE); 
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) && !isset($_SESSION['admin_id'])) {
    header("Location: Dummy_login.php");
    exit();
}

require 'includes_and_requires/bootstrap.php';
require 'styleTemp.php';

if (!isset($_GET['user_id'])) {
    $user_id = $_SESSION['link'];
} else {
    $user_id = $_GET['user_id'];
}

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

$is_banned = isUserBanned($user_id, $conn);

if (isset($_POST['ban_user'])) {
    $ban_user_id = $_POST['ban_user_id'];
    
    if ($is_banned) {
        $unban_sql = "DELETE FROM ban_table WHERE uid = '$ban_user_id'";
        $unban_result = mysqli_query($conn, $unban_sql);

        if ($unban_result) {
            echo "User with ID $ban_user_id has been unbanned!";
        } else {
            echo "Error unbanning user with ID $ban_user_id: " . mysqli_error($conn);
        }
    } else {
        // Ban the user
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
}

mysqli_free_result($result);

function isUserBanned($user_id, $conn) {
    $check_ban_sql = "SELECT COUNT(*) as count FROM ban_table WHERE uid = '$user_id'";
    $check_result = mysqli_query($conn, $check_ban_sql);

    if ($check_result) {
        $row = mysqli_fetch_assoc($check_result);
        $banCount = $row['count'];
        return ($banCount > 0);
    } else {
        return false;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - <?php echo $user['first_name'] . ' ' . $user['last_name']; ?></title>
    <?php require 'includes_and_requires/bootstrap.php'; ?>
    <?php require 'styleTemp.php'; ?>
    <script>
      function onHover(par1){
        document.getElementById(par1).style.display = "block";
      }

      function outHover(par1){
        document.getElementById(par1).style.display = "none";
      }

      function desc(flag,par){
        if(flag){
          document.getElementById(par).style.display = "block";
        }else{
          document.getElementById(par).style.display = "none";
        }
      }
    </script>
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
                <?php if ($_SESSION['user_id'] == $user['uid'] || isset($_SESSION['admin_id'])) : ?>
                    <a href="edit_profile.php?user_id=<?php echo $user['uid']; ?>">Edit Profile</a>
                <?php endif; ?>

                <?php if (isset($_SESSION['admin_id'])) : ?>
                    <form action="" method="post">
                        <input type="hidden" name="ban_user_id" value="<?php echo $user['uid']; ?>">
                        <?php if ($is_banned) : ?>
                            <button type="submit" name="ban_user" class="btn btn-success">Unban User</button>
                        <?php else : ?>
                            <button type="submit" name="ban_user" class="btn btn-danger">Ban User</button>
                        <?php endif; ?>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php
    require 'config.php';
    $_SESSION['pageUser']=$user_id;
    $sql = "select * from follower where follower_id = $_SESSION[user_id] and following_id = $_SESSION[pageUser]";
    $ret = mysqli_query($conn,$sql);
    if($_SESSION['user_id']!=$_SESSION['pageUser'] && mysqli_num_rows($ret)==0){
        echo"<form action='Controllers/FollowController.php'>
        <input type='submit' name='choice' value='follow' class='btn btn-outline-success'>
        </form>
        ";
    }else if(mysqli_num_rows($ret)>0){
      echo"<form action='Controllers/FollowController.php'>
        <input type='submit' name='choice' value='unfollow' class='btn btn-outline-danger'>
        </form>
        ";
    }
    error_reporting(E_ERROR | E_PARSE);
    if($_SESSION['succ']!=null){
      if($_SESSION['comment']!=null){
        echo "<div class='alert alert-success' role='alert'>
        Comment Added!
      </div>";
      } else if ($_SESSION['like'] != null) {
        if($_SESSION['like'] == 'Like'){
        echo "<div class='alert alert-success' role='alert'>
    Like Added!
  </div>";
    }
    else if($_SESSION['like'] == 'Unlike'){
        echo "<div class='alert alert-success' role='alert'>
    Like Removed!
    </div>";
        }
        }
}else if($_SESSION['failed']!=null){
      if($_SESSION['like']!=null){
        echo "<div class='alert alert-danger' role='alert'>
        Like failed to add!
      </div>";
      } else if($_SESSION['comment']==null || $_SESSION['comment']!=null){
        echo "<div class='alert alert-danger' role='alert'>
        Comment failed to add!
      </div>";
      }
    }
    unset($_SESSION['failed']);
    unset($_SESSION['succ']);
    unset($_SESSION['comment']);
    unset($_SESSION['like']);
    $sql = "select * from post where user_id = $_SESSION[pageUser] order by published_at desc";
      $ret = mysqli_query($conn,$sql);
      if(mysqli_num_rows($ret)>0){
        while($row = mysqli_fetch_assoc($ret)){
          $sql = "Select * from page_user where uid = {$row['user_id']}";
          $ret2 = mysqli_query($conn,$sql);
          $row2 = mysqli_fetch_assoc($ret2);
          $sql = "Select * from postingredient where post_id = {$row['pid']} limit 3";
          $ret3 = mysqli_query($conn,$sql);
          echo"
          <div class='card'>
      <div class='custom_image' style='background-image:url({$row['img_url']})'></div>
      <div class='card-body'>
        <h5 class='card-title'>{$row['title']} ({$row2['first_name']})</h5>
        <p class='card-text' onmouseover='onHover({$row['pid']})' onmouseout='outHover({$row['pid']})'>
          Ingredients: <ul>";
          while($row3 = mysqli_fetch_assoc($ret3)){
            echo "<li>{$row3['ingredient_name']}</li>";
          }
        echo"
        <li>...</li>
        </ul>
        </p>
        <p>";
        $sql = "select count(pid) as count from post_like
        where pid = {$row['pid']}";
        $ret4 = mysqli_query($conn, $sql);
      $count = mysqli_fetch_assoc($ret4);
      $sql = "SELECT * FROM post_like WHERE pid = {$row['pid']} AND uid = {$_SESSION['user_id']}";
      $ret5 = mysqli_query($conn, $sql);
      echo "{$count['count']}";
      echo " Likes</p>
<form action='Controllers/LCController.php'>
<input type='submit' class='btn btn-outline-success' value='" . (mysqli_num_rows($ret5)>0 ? 'Unlike' : 'Like') . "' name='like'>
        <input type='submit' class='btn btn-outline-success' value='Comment' name='comm'>
        <input type='text' name='comment' >
        <input type = 'hidden' name='user' value='$_SESSION[user_id]'>
        <input type = 'hidden' name='post' value='{$row['pid']}'>
        <input type = 'hidden' name='loc' value='user'>
        </form>
      </div>
      <button onclick='desc(1,\"post{$row['pid']}\")' class='btn btn-outline-success open'>Open Description</button>
      <div class='coms'><b><u><p>Comments:</p></u></b>";
      $sql = "select first_name, content
      from post_comment as pc
      join page_user as pu on pc.uid = pu.uid
      where pid = {$row['pid']}
      ";
      $retCom = mysqli_query($conn,$sql);
      if(mysqli_num_rows($retCom)==0){
        echo "<p>No comments...</p>";
      }else{
        while($coms = mysqli_fetch_assoc($retCom)){
          echo "<p>{$coms['first_name']}: {$coms['content']}</p>";
        }
      }
      echo"</div>
    </div>";

      $sql = "Select * from postingredient where post_id = {$row['pid']}";
        $ret3 = mysqli_query($conn,$sql);
        echo"<div class = 'postIng' id = '{$row['pid']}'><p>INGREDIENTS:</p><ul>";
        while($row3 = mysqli_fetch_assoc($ret3)){
          echo"<li>{$row3['ingredient_name']}</li>";
        }
        echo"</ul></div>";
        $ret4 =  mysqli_query($conn,"Select * from post where pid = {$row['pid']}");
        echo "<div class = 'postDesc' id='post{$row['pid']}'> <h2>Description:</h2>";
        while($row4 = mysqli_fetch_assoc($ret4)){
          echo"<p>{$row4['caption']}</p><button onclick='desc(0,\"post{$row['pid']}\")' class='btn btn-outline-success'>Close Description</button>";
        }
        echo"</div>";
        
      }
        
      }
    if($ret!==null)
      mysqli_free_result($ret);
    if($ret3!=null)
      mysqli_free_result($ret3);
    mysqli_close($conn);
    ?>

</body>

</html>
