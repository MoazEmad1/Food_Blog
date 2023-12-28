<?php
include 'config.php';
require 'includes_and_requires/bootstrap.php';
require 'includes_and_requires/menu.php';
require 'styleTemp.php';
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action']; 

    // Extract item details from the form
    $itemName = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $imgUrl = $_POST['img_url'];
    $isVeg = $_POST['is_veg'];

    // Sanitize inputs (prevent SQL injection)
    $itemName = htmlspecialchars($itemName);
    $quantity = intval($quantity);
    $price = floatval($price);
    $imgUrl = htmlspecialchars($imgUrl);
    $isVeg = intval($isVeg);

    // Validate inputs (perform additional validation as needed)
    if (empty($itemName) || $quantity <= 0 || $price <= 0) {
        // Handle validation errors
        echo "Invalid input. Please check your input and try again.";
    } else {
        // Include your database connection file here
        // For example, include_once('db_connection.php');

        // Database query based on the action (add or edit)
        if ($action == 'add') {
            // Perform SQL query to add the item to the database
            $sql = "INSERT INTO grocery_item (quantity, price, item_name, img_url, is_veg) 
                    VALUES ('$quantity', '$price', '$itemName', '$imgUrl', '$isVeg')";
        } elseif ($action == 'edit') {
            // Extract the item ID to edit
            $itemId = $_POST['item_id'];

            // Sanitize and validate item ID
            $itemId = intval($itemId);
            if ($itemId <= 0) {
                // Handle validation errors
                echo "Invalid item ID. Please check your input and try again.";
                exit();
            }

            // Perform SQL query to edit the item in the database
            $sql = "UPDATE grocery_item 
                    SET quantity='$quantity', price='$price', item_name='$itemName', img_url='$imgUrl', is_veg='$isVeg' 
                    WHERE gid='$itemId'";
        }

        // Execute the SQL query
        // Note: Replace $db with your actual database connection variable
        if (mysqli_query($db, $sql)) {
            echo "Operation successful!";
        } else {
            echo "Error: " . mysqli_error($db);
        }
    }
}

// Below is the HTML form for adding/editing items
// You can customize this form based on your requirements

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Manage Items</title>
</head>
<body>
    <h2>Admin Manage Items</h2>

    <!-- Add Item Form -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="action" value="add">
        <label for="item_name">Item Name:</label>
        <input type="text" name="item_name" required>
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" required>
        <label for="price">Price:</label>
        <input type="number" step="0.01" name="price" required>
        <label for="img_url">Image URL:</label>
        <input type="text" name="img_url" required>
        <label for="is_veg">Is Vegetarian:</label>
        <input type="number" name="is_veg" min="0" max="1" required>
        <button type="submit">Add Item</button>
    </form>

    <!-- Edit Item Form -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="action" value="edit">
        <label for="item_id">Item ID to Edit:</label>
        <input type="number" name="item_id" required>
        <label for="item_name">New Item Name:</label>
        <input type="text" name="item_name" required>
        <label for="quantity">New Quantity:</label>
        <input type="number" name="quantity" required>
        <label for="price">New Price:</label>
        <input type="number" step="0.01" name="price" required>
        <label for="img_url">New Image URL:</label>
        <input type="text" name="img_url" required>
        <label for="is_veg">New Is Vegetarian:</label>
        <input type="number" name="is_veg" min="0" max="1" required>
        <button type="submit">Edit Item</button>
    </form>
</body>
</html>
