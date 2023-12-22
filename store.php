<?php
session_start();
include 'config.php';
include 'styleTemp.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedItemId = $_POST["item_id"];
    $selectedQuantity = $_POST["quantity"];

    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
        $userId = $_SESSION['user_id'];

        $checkCartSql = "SELECT * FROM cart WHERE user_id = $userId AND item_id = $selectedItemId";
        $checkCartResult = $conn->query($checkCartSql);

        if ($checkCartResult->num_rows > 0) {
            $updateCartSql = "UPDATE cart SET quantity = quantity + $selectedQuantity WHERE user_id = $userId AND item_id = $selectedItemId";
            $conn->query($updateCartSql);
        } else {
            $addToCartSql = "INSERT INTO cart (user_id, item_id, quantity) VALUES ($userId, $selectedItemId, $selectedQuantity)";
            $conn->query($addToCartSql);
        }

        $updateStockSql = "UPDATE grocery_item SET quantity = quantity - $selectedQuantity WHERE gid = $selectedItemId";
        $conn->query($updateStockSql);

        echo "<p style='color: green;'>Item added to cart successfully!</p>";
    } else {
        header("Location: Dummy_login.php");
        exit();
    }
}

$sql = "SELECT * FROM grocery_item";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<h2>" . $row["item_name"] . "</h2>";
        echo "<p>Quantity: " . $row["quantity"] . "</p>";
        echo "<p>Price: $" . $row["price"] . "</p>";
        echo "<img src='" . $row["img_url"] . "' alt='" . $row["item_name"] . "' style='max-width: 200px;'>";

        if ($row["quantity"] > 0) {
            echo "<p style='color: green;'>In Stock</p>";

            echo "<form method='post' action='" . $_SERVER["PHP_SELF"] . "'>";
            echo "<input type='hidden' name='item_id' value='" . $row["gid"] . "'>";
            echo "<label for='quantity'>Quantity:</label>";
            echo "<input type='number' name='quantity' value='1' min='1' max='" . $row["quantity"] . "' required>";
            echo "<button type='submit'>Add to Cart</button>";
            echo "</form>";
        } else {
            echo "<p style='color: red;'>Out of Stock</p>";
            echo "<button disabled>Add to Cart</button>";
        }

        echo "</div>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>
