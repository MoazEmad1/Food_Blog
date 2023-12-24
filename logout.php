<?php
session_start();
session_destroy();
header("Location: Dummy_login.php");
exit();
?>
