<?php
require 'config.php';
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: Dummy_login.php");
    exit();
}
if(isset($_SESSION['admin_id'])){
    header("Location: hompage.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $phone_number = $_POST["phone_number"];
    $additional_phone = $_POST["additional_phone"];
    $address = $_POST["address"];
    $additional_info = $_POST["additional_info"];
    $city = $_POST["city"];
    $set_default = isset($_POST["set_default"]) ? 1 : 0;

    $check_address_sql = "SELECT COUNT(*) AS address_count FROM user_address WHERE user_id = '$user_id'";
    $result = $conn->query($check_address_sql);
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $address_count = $row['address_count'];
        if ($set_default == 0 && $address_count == 0) {
            $set_default = 1;
        }
    }

    $sql = "INSERT INTO user_address (user_id, first_name, last_name, phone_number, phone_prefix, additional_phone, address, additional_info, city, set_default)
            VALUES ('$user_id', '$first_name', '$last_name', '$phone_number', '+20', '$additional_phone', '$address', '$additional_info', '$city', '$set_default')";

    if ($conn->query($sql) === TRUE) {
        header("Location: payment.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
