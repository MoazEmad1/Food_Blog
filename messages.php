<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YumNet HomePage</title>
    <?php require 'includes_and_requires/bootstrap.php' ?>
    <?php require 'styleTemp.php' ?>
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
    $sql = "SELECT * FROM ban_table WHERE uid = $user_id";
    $result = mysqli_query($conn, $sql);
    if($_GET['receiver']==null)
        $receiver_id = $_SESSION['receiver'];
    else
        $receiver_id = $_GET['receiver'];
    if (mysqli_num_rows($result) > 0) {
        header("Location: Dummy_login.php");
        exit();
    }
    require 'config.php';
    mysqli_free_result($result);
    $sql = "SELECT * from message 
            where (personA = $user_id and personB = $receiver_id) or (personA = $receiver_id and personB = $user_id)";
    $ret = mysqli_query($conn,$sql);
  ?>
  <div class="message_box">
    <?php
        while($row = mysqli_fetch_assoc($ret)){
            if($row['personA']==$user_id){
                echo"<div class = 'sender'>
                        <p>{$row['mesageContent']}</p>
                     </div>";
            }else if($row['personB']==$user_id){
                echo"<div class = 'receiver'>
                        <p>{$row['mesageContent']}</p>
                     </div>";
            }
        }
    ?>
  </div>
  <form action="Controllers/messageController.php">
    <textarea name="mes"cols="60" rows="5" placeholder="Send your message here...."></textarea>
    <br>
    <input type="submit" name="send" value="send">
    <input type="hidden" value="<?php echo $user_id;?>" name="sender">
    <input type="hidden" value="<?php echo $receiver_id;?>" name="receiver">
  </form>
  <?php $conn->close();?>
</body>
</html>
