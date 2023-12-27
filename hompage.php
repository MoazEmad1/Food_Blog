<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YumNet HomePage</title>
    <?php require 'includes_and_requires/bootstrap.php' ?>
    <?php require 'styleTemp.php' ?>
    <script>
        function onHover(par1) {
            document.getElementById(par1).style.display = "block";
        }

        function outHover(par1) {
            document.getElementById(par1).style.display = "none";
        }

        function desc(flag, par) {
            if (flag) {
                document.getElementById(par).style.display = "block";
            } else {
                document.getElementById(par).style.display = "none";
            }
        }
    </script>
</head>

<body>
    <?php include 'includes_and_requires/menu.php' ?>
    <?php
    if (!isset($_SESSION['admin_id']) && !isset($_SESSION['user_id'])) {
        header("Location: Dummy_login.php");
        exit();
    }
    require 'config.php';
    $user_id = $_SESSION['user_id'];
    if(isset($_SESSION['user_id'])){
    $sql = "SELECT * FROM ban_table WHERE uid = $user_id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        header("Location: Dummy_login.php");
        exit();
    }
}
    if ($_SESSION['succ'] != null) {
        if ($_SESSION['comment'] != null) {
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
    } else if ($_SESSION['failed'] != null) {
        if ($_SESSION['like'] != null) {
            echo "<div class='alert alert-danger' role='alert'>
        Like failed to add!
      </div>";
        }
        else if ($_SESSION['like'] != null) {
            echo "<div class='alert alert-danger' role='alert'>
            Failed to unlike!
            </div>";
        } else if ($_SESSION['comment'] == null || $_SESSION['comment'] != null) {
            echo "<div class='alert alert-danger' role='alert'>
        Comment failed to add!
      </div>";
        }
    }
    unset($_SESSION['failed']);
    unset($_SESSION['succ']);
    unset($_SESSION['comment']);
    unset($_SESSION['like']);
    require 'config.php';
    $sql="";
    if(!isset($_SESSION['admin_id'])){
        $sql = "select * from follower where follower_id = $_SESSION[user_id]";
    }else{
        $sql = "select * from follower where follower_id = $_SESSION[admin_id]";
    }
        
    $ret = mysqli_query($conn, $sql);
    if (mysqli_num_rows($ret) > 0 && !isset($_SESSION['admin_id'])) {
        $sql = "select * from post 
      join page_user as pu on user_id = pu.uid
      join follower as f on pu.uid = f.following_id
      where f.follower_id = $_SESSION[user_id] order by published_at desc";
        $ret = mysqli_query($conn, $sql);
        if (mysqli_num_rows($ret) > 0) {
            while ($row = mysqli_fetch_assoc($ret)) {
                $sql = "Select * from page_user where uid = {$row['user_id']}";
                $ret2 = mysqli_query($conn, $sql);
                $row2 = mysqli_fetch_assoc($ret2);
                $sql = "Select * from postingredient where post_id = {$row['pid']} limit 3";
                $ret3 = mysqli_query($conn, $sql);
                echo "
          <div class='card'>
      <div class='custom_image' style='background-image:url({$row['img_url']})'></div>
      <div class='card-body'>
      <h5 class='card-title'>{$row['title']} <a href='Controllers/pfpPagelink.php?user_id={$row2['uid']}'>({$row2['first_name']})</a></h5>
      <p class='card-text' onmouseover='onHover({$row['pid']})' onmouseout='outHover({$row['pid']})'>
          Ingredients: <ul>";
                while ($row3 = mysqli_fetch_assoc($ret3)) {
                    echo "<li>{$row3['ingredient_name']}</li>";
                }
                echo "
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
        <input type = 'hidden' name='loc' value='home'>
        </form>
      </div>
      <button onclick='desc(1,\"post{$row['pid']}\")' class='btn btn-outline-success open'>Open Description</button>
      <div class='coms'><b><u><p>Comments:</p></u></b>";
                $sql = "select first_name, content
      from post_comment as pc
      join page_user as pu on pc.uid = pu.uid
      where pid = {$row['pid']}
      ";
                $retCom = mysqli_query($conn, $sql);
                if (mysqli_num_rows($retCom) == 0) {
                    echo "<p>No comments...</p>";
                } else {
                    while ($coms = mysqli_fetch_assoc($retCom)) {
                        echo "<p>{$coms['first_name']}: {$coms['content']}</p>";
                    }
                }
                echo "</div>
    </div>";

                $sql = "Select * from postingredient where post_id = {$row['pid']}";
                $ret3 = mysqli_query($conn, $sql);
                echo "<div class = 'postIng' id = '{$row['pid']}'><p>INGREDIENTS:</p><ul>";
                while ($row3 = mysqli_fetch_assoc($ret3)) {
                    echo "<li>{$row3['ingredient_name']}</li>";
                }
                echo "</ul></div>";
                $ret4 =  mysqli_query($conn, "Select * from post where pid = {$row['pid']}");
                echo "<div class = 'postDesc' id='post{$row['pid']}'> <h2>Description:</h2>";
                while ($row4 = mysqli_fetch_assoc($ret4)) {
                    echo "<p>{$row4['caption']}</p><button onclick='desc(0,\"post{$row['pid']}\")' class='btn btn-outline-success'>Close Description</button>";
                }
                echo "</div>";

            }

        }
    } else {
        $sql = "select * from post order by published_at desc";
        $ret = mysqli_query($conn, $sql);
        if (mysqli_num_rows($ret) > 0) {
            while ($row = mysqli_fetch_assoc($ret)) {
              $sql = "Select * from page_user where uid= {$row['user_id']}";
              $ret2 = mysqli_query($conn, $sql);
              $row2 = mysqli_fetch_assoc($ret2);
              $sql = "Select * from postingredient where post_id = {$row['pid']} limit 3";
              $ret3 = mysqli_query($conn, $sql);
              echo "
        <div class='card'>
    <div class='custom_image' style='background-image:url({$row['img_url']})'></div>
    <div class='card-body'>
    <h5 class='card-title'>{$row['title']} <a href='Controllers/pfpPagelink.php?user_id={$row2['uid']}'>({$row2['first_name']})</a></h5>
    <p class='card-text' onmouseover='onHover({$row['pid']})' onmouseout='outHover({$row['pid']})'>
        Ingredients: <ul>";
              while ($row3 = mysqli_fetch_assoc($ret3)) {
                  echo "<li>{$row3['ingredient_name']}</li>";
              }
              echo "
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
      <input type = 'hidden' name='loc' value='home'>
      </form>
    </div>
    <button onclick='desc(1,\"post{$row['pid']}\")' class='btn btn-outline-success open'>Open Description</button>
    <div class='coms'><b><u><p>Comments:</p></u></b>";
              $sql = "select first_name, content
    from post_comment as pc
    join page_user as pu on pc.uid = pu.uid
    where pid = {$row['pid']}
    ";
              $retCom = mysqli_query($conn, $sql);
              if (mysqli_num_rows($retCom) == 0) {
                  echo "<p>No comments...</p>";
              } else {
                  while ($coms = mysqli_fetch_assoc($retCom)) {
                      echo "<p>{$coms['first_name']}: {$coms['content']}</p>";
                  }
              }
              echo "</div>
  </div>";

              $sql = "Select * from postingredient where post_id = {$row['pid']}";
              $ret3 = mysqli_query($conn, $sql);
              echo "<div class = 'postIng' id = '{$row['pid']}'><p>INGREDIENTS:</p><ul>";
              while ($row3 = mysqli_fetch_assoc($ret3)) {
                  echo "<li>{$row3['ingredient_name']}</li>";
              }
              echo "</ul></div>";
              $ret4 =  mysqli_query($conn, "Select * from post where pid = {$row['pid']}");
              echo "<div class = 'postDesc' id='post{$row['pid']}'> <h2>Description:</h2>";
              while ($row4 = mysqli_fetch_assoc($ret4)) {
                  echo "<p>{$row4['caption']}</p><button onclick='desc(0,\"post{$row['pid']}\")' class='btn btn-outline-success'>Close Description</button>";
              }
              echo "</div>";

          }
      }
  }
  if ($ret !== null) mysqli_free_result($ret);
  if ($ret3 != null) mysqli_free_result($ret3);
  mysqli_close($conn);
  ?>
</body>
</html>
