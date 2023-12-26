    <?php
    require 'config.php';
    require 'includes_and_requires/bootstrap.php';
    session_start();
    include 'styleTemp.php';
    include 'includes_and_requires/menu.php';
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    $userID = $_SESSION['user_id'];

    $sql = "SELECT * FROM user_address WHERE user_id = '$userID'";
    $result = $conn->query($sql);

    $addresses = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $addresses[] = $row;
        }
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['from_payment_page'])) {
        $selectedAddressID = $_POST["selected_address"];

        $updateSql = "UPDATE user_address SET set_default = '0' WHERE user_id = '$userID'";
        $conn->query($updateSql);

        $updateSql = "UPDATE user_address SET set_default = '1' WHERE user_id = '$userID' AND address_id = '$selectedAddressID'";

        if ($conn->query($updateSql) === TRUE) {
            echo "Address updated successfully!";
            header("Location: payment.php");
            exit();
        } else {
            echo "Error updating address: " . $conn->error;
        }
    }

    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Change Address</title>
    </head>

    <body>
        <div class="container">
            <h1 class="mt-5">Change Address</h1>

            <?php if (!empty($addresses)) : ?>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <p>Select an address:</p>
                    <select name="selected_address" class="form-control">
                        <?php foreach ($addresses as $address) : ?>
                            <option value="<?php echo $address['address_id']; ?>">
                                <?php echo "{$address['first_name']} {$address['last_name']}, {$address['address']}"; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <input type="hidden" name="from_payment_page" value="1">
                    <button type="submit">Submit</button>
                </form>
            <?php else : ?>
                <p>No addresses found. Please add a new address.</p>
            <?php endif; ?>

            <a href="payment.php" class="btn btn-secondary mt-3">Return to Payment Page</a>
            <a href="add_address.php" class="btn btn-success mt-3">Add New Address</a>
        </div>
    </body>

    </html>
