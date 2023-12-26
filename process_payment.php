<?php
require 'config.php';
require 'includes_and_requires/bootstrap.php';
session_start();
include 'styleTemp.php';
include 'includes_and_requires/menu.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $address_id = $_POST['selected_address'];
    $total_amount = $_SESSION['total_amount'];
    $payment_method = $_POST['payment_method'];

    // Insert order into the orders table
    $insert_order_sql = "INSERT INTO orders (user_id, address_id, total_amount, payment_method) 
                        VALUES ('$user_id', '$address_id', '$total_amount', '$payment_method')";

    if ($conn->query($insert_order_sql) === TRUE) {
        $order_id = $conn->insert_id;
        
        // Update stock quantities in grocery_item table
        $update_stock_sql = "UPDATE grocery_item gi
                             JOIN cart c ON gi.gid = c.item_id
                             SET gi.quantity = gi.quantity - c.quantity
                             WHERE c.user_id = '$user_id'";
        $conn->query($update_stock_sql);

        // Clear user's cart
        $clear_cart_sql = "DELETE FROM cart WHERE user_id = '$user_id'";
        $conn->query($clear_cart_sql);

        echo "<div class='text-center'>
                <h2 class='mb-4'>Order Placed Successfully!</h2>
                <p class='lead'>Thank you for your order.</p>
                <a href='store.php' class='btn btn-primary'>Continue Shopping</a>
            </div>";
    } else {
        echo "Error: " . $insert_order_sql . "<br>" . $conn->error;
    }
}
?>
