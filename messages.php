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
<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'includes_and_requires/menu.php' ;
        require 'config.php';
    if (!isset($_SESSION['user_id'])) {
        header("Location: Dummy_login.php");
        exit();
    }

    if(isset($_SESSION['admin_id'])){
        header("Location: hompage.php");
        exit();
    }
    
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM ban_table WHERE uid = $user_id";
    $result = mysqli_query($conn, $sql);
    $receiver_id = $_SESSION['receiver'];
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
        while ($row = mysqli_fetch_assoc($ret)) {
            if ($row['personA'] == $user_id) {
                echo "<div class='sender'>
                        <p class='message' data-message='{$row['mesageContent']}'>{$row['mesageContent']}</p>
                     </div>";
            } else if ($row['personB'] == $user_id) {
                echo "<div class='receiver'>
                        <p class='message' data-message='{$row['mesageContent']}'>{$row['mesageContent']}</p>
                     </div>";
            }
        }
        ?>
    </div>
    <form action="Controllers/messageController.php">
        <textarea id="messageInput" name="mes" cols="60" rows="5" placeholder="Send your message here...."></textarea>
        <button type="button" id="speechToTextButton">Speech to Text</button>
        <br>
        <input type="submit" name="send" value="send">
        <input type="hidden" value="<?php echo $user_id; ?>" name="sender">
        <input type="hidden" value="<?php echo $receiver_id; ?>" name="receiver">
    </form>

    <script>
        document.addEventListener('keydown', function (event) {
            var activeElement = document.activeElement;
            var messageInput = document.getElementById('messageInput');

            if (event.key === 't' && activeElement !== messageInput) {
                var messages = document.querySelectorAll('.message');
                var lastMessage = messages[messages.length - 1];
                var messageText = lastMessage.getAttribute('data-message');

                var speechSynthesis = window.speechSynthesis;
                var speechUtterance = new SpeechSynthesisUtterance(messageText);
                speechSynthesis.speak(speechUtterance);
            }
        });

        document.getElementById('speechToTextButton').addEventListener('click', function () {
            var recognition = new webkitSpeechRecognition(); 

            recognition.onresult = function (event) {
                var transcript = event.results[0][0].transcript;

                document.getElementById('messageInput').value += transcript + ' ';
            };

            recognition.start();
        });
    </script>

    <?php $conn->close(); ?>
</body>

</html>