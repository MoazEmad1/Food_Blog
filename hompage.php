<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YumNet HomePage</title>
    <?php require 'includes_and_requires/bootstrap.php'?>
    <?php require 'styleTemp.php'?>
    <script>
      function onHover(par1){
        document.getElementById(par1).style.display = "block";
      }

      function outHover(par1){
        document.getElementById(par1).style.display = "none";
      }
    </script>
</head>
<body>
    <?php include 'includes_and_requires/menu.php'?>
    <?php
    //error_reporting(E_ERROR | E_PARSE);
    if($_GET['comm']!=null || $_GET['like']!=NULL){
      echo"YES";
    }
    require 'config2.php';
    $follower_id = 1;
    $sql = "select * from follower where follower_id = 1";
    $ret = mysqli_query($conn,$sql);
    if(mysqli_num_rows($ret)>0){
      echo"YES";
    }else{
      mysqli_free_result($ret);
      $sql = "select * from post order by published_at";
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
        <p>10k Likes</p>
        <form action='Controllers/LCController.php'>
        <input type='submit' class='btn btn-outline-success' value='Like' name='like'>
        <input type='submit' class='btn btn-outline-success' value='Comment' name='comm'>
        <input type='text' name='comment' >
        <input type = 'hidden' name='user' value='{$row['user_id']}'>
        <input type = 'hidden' name='post' value='{$row['pid']}'>
        </form>
      </div>
    </div>";

      $sql = "Select * from postingredient where post_id = {$row['pid']}";
        $ret3 = mysqli_query($conn,$sql);
        echo"<div class = 'postIng' id = '{$row['pid']}'><p>INGREDIENTS:</p><ul>";
        while($row3 = mysqli_fetch_assoc($ret3)){
          echo"<li>{$row3['ingredient_name']}</li>";
        }
        echo"</ul></div>";
        }
      }
    }
    mysqli_free_result($ret);
    mysqli_free_result($ret3);
    mysqli_close($conn);
    ?>
</body>
</html>