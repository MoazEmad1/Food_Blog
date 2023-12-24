<?php 
include 'styleTemp.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Page</title>
</head>
<body>
    <h1>Payment Page</h1>

    <form action="process_payment.php" method="POST">
        <label for="card_number">Card Number:</label>
        <input type="text" id="card_number" name="card_number" required>

        <label for="expiry_date">Expiry Date:</label>
        <input type="text" id="expiry_date" name="expiry_date" required>

        <label for="cvv">CVV:</label>
        <input type="text" id="cvv" name="cvv" required>

        <input type="submit" value="Pay">
    </form>
</body>
</html>
