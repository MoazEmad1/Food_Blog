<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <?php require 'includes_and_requires/bootstrap.php'?>
    <?php require 'styleTemp.php'?>
</head>
<body>
    <?php include 'includes_and_requires/menu.php'?>
    <div class="container mt-5">
        <h2>Your Cart</h2>
        <?php
        session_start();
        $user_id = $_SESSION['user_id'];

        require 'config.php';

        $remove_zero_sql = "DELETE FROM cart WHERE user_id = $user_id AND quantity = 0";
        mysqli_query($conn, $remove_zero_sql);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['update_cart'])) {
                foreach ($_POST['quantity'] as $cart_id => $new_quantity) {
                    $new_quantity = max(0, intval($new_quantity));

                    $stock_query = "SELECT grocery_item.quantity AS stock
                                    FROM cart
                                    JOIN grocery_item ON cart.item_id = grocery_item.gid
                                    WHERE cart.cart_id = $cart_id AND cart.user_id = $user_id";

                    $stock_result = mysqli_query($conn, $stock_query);

                    if ($stock_result && mysqli_num_rows($stock_result) > 0) {
                        $stock_row = mysqli_fetch_assoc($stock_result);
                        $max_quantity = $stock_row['stock'];
                        $new_quantity = min($new_quantity, $max_quantity);
                    }

                    $update_sql = "UPDATE cart SET quantity = $new_quantity WHERE cart_id = $cart_id AND user_id = $user_id";
                    mysqli_query($conn, $update_sql);
                }
            }
            
            header("Location: payment.php");
            exit();
        }

        $sql = "SELECT cart.cart_id, grocery_item.item_name, cart.quantity, grocery_item.price, grocery_item.quantity AS stock
                FROM cart
                JOIN grocery_item ON cart.item_id = grocery_item.gid
                WHERE cart.user_id = $user_id";

        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            echo "<form method='post' action='" . $_SERVER["PHP_SELF"] . "'>";
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['quantity'] > 0) {
                    echo "
                    <div class='card mb-3'>
                        <div class='card-body'>
                            <h5 class='card-title'>{$row['item_name']}</h5>
                            <p class='card-text'>Quantity:
                                <input type='number' name='quantity[{$row['cart_id']}]' value='{$row['quantity']}' min='0' max='{$row['stock']}'>
                            </p>
                            <p class='card-text'>Price: $" . ($row['quantity'] * $row['price']) . "</p>
                        </div>
                    </div>";
                }
            }
            echo "<button type='submit' class='btn btn-success' name='update_cart'>Proceed to Payment</button>";
            echo "</form>";
        } else {
            echo "<p>Your cart is empty.</p>";
        }

        mysqli_close($conn);
        ?>
    </div>
</body>
</html>
