<?php
include 'config.php';
include 'includes_and_requires/menu.php';
include 'includes_and_requires/bootstrap.php';
include 'styleTemp.php';

echo "<div class='container mt-5'>";

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

        echo "<p style='color: green;'>Item added to cart successfully!</p>";
    } else {
        header("Location: Dummy_login.php");
        exit();
    }
}

$sql = "SELECT * FROM grocery_item";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $count = 0;
    echo "<div class='row'>";
    while ($row = $result->fetch_assoc()) {
        if ($count % 3 == 0 && $count != 0) {
            echo "</div><div class='row'>";
        }
        echo "<div class='col-md-4 mb-4'>";
        echo "<div class='card' style='width: 18rem;'>";
        echo "<img src='Users/test/images/" . $row["img_url"] . "' class='card-img-top mx-auto' alt='" . $row["item_name"] . "' style='max-width: 200px;'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>" . $row["item_name"] . "</h5>";
        echo "<p class='card-text'>Price: $" . $row["price"] . "</p>";

        if ($row["quantity"] > 0) {
            echo "<p style='color: green;'>In Stock</p>";

            echo "<form method='post' action='" . $_SERVER["PHP_SELF"] . "'>";
            echo "<input type='hidden' name='item_id' value='" . $row["gid"] . "'>";
            echo "<label for='quantity'>Quantity:</label>";
            echo "<input type='number' name='quantity' value='1' min='1' max='" . $row["quantity"] . "' required>";
            echo "<button type='submit' class='btn btn-success'>Add to Cart</button>";
            echo "</form>";
        } else {
            echo "<p style='color: red;'>Out of Stock</p>";
            echo "<button disabled class='btn btn-secondary'>Add to Cart</button>";
        }

        echo "</div></div></div>";
        $count++;
    }
    echo "</div>";
} else {
    echo "0 results";
}

echo "</div>";

$conn->close();
?>
