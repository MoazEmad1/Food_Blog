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
    require 'config.php';
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
          $sql = "Select first_name from page_user where uid = {$row['user_id']}";
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
        <button type='button' class='btn btn-outline-success'>Like</button>
        <button type='button' class='btn btn-outline-success'>Comments</button>
      </div>
    </div>";

      $sql = "Select * from postingredient where post_id = {$row['pid']}";
        $ret = mysqli_query($conn,$sql);
        echo"<div class = 'postIng' id = '{$row['pid']}'><p>INGREDIENTS:</p><ul>";
        while($row3 = mysqli_fetch_assoc($ret)){
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