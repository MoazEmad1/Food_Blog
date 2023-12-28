<?php
require 'config.php';
require 'includes_and_requires/bootstrap.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: Dummy_login.php");
    exit();
}

if(isset($_SESSION['admin_id'])){
    header("Location: hompage.php");
    exit();
}
$user_id = $_SESSION['user_id'];

// Check if the cart is empty
$cart_check_sql = "SELECT COUNT(*) as cart_count FROM cart WHERE user_id = $user_id";
$cart_check_result = mysqli_query($conn, $cart_check_sql);
$cart_count_row = mysqli_fetch_assoc($cart_check_result);

if ($cart_count_row['cart_count'] == 0) {
    header("Location: store.php");
    exit();
}

$default_address_sql = "SELECT * FROM user_address WHERE user_id = '$user_id' AND set_default = 1";
$result = $conn->query($default_address_sql);

$default_address = null;

if ($result->num_rows > 0) {
    $default_address = $result->fetch_assoc();
}

if (!$default_address) {
    header("Location: add_address.php");
    exit();
}

include 'styleTemp.php';
include 'includes_and_requires/menu.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <script>
        function toggleCreditCardFields() {
            var paymentMethod = document.getElementById("payment_method").value;
            var creditCardFields = document.getElementById("credit_card_fields");
            var cardNumber = document.getElementById("card_number");
            var expiryDate = document.getElementById("expiry_date");
            var cvv = document.getElementById("cvv");
            var payButton = document.getElementById("pay_button");

            if (paymentMethod === "cod") {
                creditCardFields.style.display = "none";
                cardNumber.removeAttribute("required");
                expiryDate.removeAttribute("required");
                cvv.removeAttribute("required");
                payButton.disabled = false;
            } else {
                creditCardFields.style.display = "block";
                cardNumber.setAttribute("required", "");
                expiryDate.setAttribute("required", "");
                cvv.setAttribute("required", "");
                payButton.disabled = true;
            }
        }
    </script>
</head>

<body>
    <div class="container">
        <h1 class="mt-5">Payment Page</h1>

        <div class="mt-3">
            <h2>Your Default Address:</h2>
            <p>First Name: <?php echo $default_address['first_name']; ?></p>
            <p>Last Name: <?php echo $default_address['last_name']; ?></p>
            <p>Phone Number: <?php echo $default_address['phone_number']; ?></p>
            <p>Additional Phone Number: <?php echo $default_address['additional_phone']; ?></p>
            <p>Address: <?php echo $default_address['address']; ?></p>
            <p>Additional Information: <?php echo $default_address['additional_info']; ?></p>
            <p>City: <?php echo $default_address['city']; ?></p>
            <form action="change_address.php" method="POST">
                <button type="submit" class="btn btn-primary">Change Address</button>
            </form>
        </div>

        <form action="process_payment.php" method="POST">
            <input type="hidden" name="selected_address" value="<?php echo $default_address['address_id']; ?>">

            <div class="form-group">
                <label for="payment_method">Select Payment Method:</label>
                <select class="form-control" id="payment_method" name="payment_method" onchange="toggleCreditCardFields()" required>
                    <option value="card">Credit/Debit Card</option>
                    <option value="cod">Cash on Delivery</option>
                </select>
            </div>

            <div id="credit_card_fields">
                <div class="form-group">
                    <label for="card_number">Card Number:</label>
                    <input type="text" class="form-control" id="card_number" name="card_number" required>
                </div>

                <div class="form-group">
                    <label for="expiry_date">Expiry Date:</label>
                    <input type="text" class="form-control" id="expiry_date" name="expiry_date" required>
                </div>

                <div class="form-group">
                    <label for="cvv">CVV:</label>
                    <input type="text" class="form-control" id="cvv" name="cvv" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" id="pay_button">Pay</button>
        </form>
    </div>
</body>

</html>
