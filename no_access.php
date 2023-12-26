<?php
session_start();
include 'config.php';
require 'includes_and_requires/bootstrap.php';
require 'styleTemp.php';
if (!isset($_SESSION['user_id']) && !isset($_SESSION['admin_id'])) {
    header("Location: Dummy_login.php");
    exit();
}
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center"> 
            <h2>You don't have access for this page.</h2>
        </div>
    </div>
</div>
