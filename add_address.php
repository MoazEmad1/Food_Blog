<?php 
require 'config.php';
require 'includes_and_requires/bootstrap.php';
session_start();
include 'styleTemp.php';
include 'includes_and_requires/menu.php';
if(!isset($_SESSION['user_id'])){
    header("Locaction: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Address Page</title>
</head>

<body>
    <div class="container">
        <h1 class="mt-5">ADD NEW ADDRESS</h1>

        <form action="process_address.php" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="first_name">First Name:</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter your First Name" required>
                    </div>
                    <br>

                    <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">+20</span>
                    </div>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter your phone number" required>
                </div>
            </div>

                </div>
    
                <div class="col-md-6">
                    
                    <div class="form-group">
                        <label for="last_name">Last Name:</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter your Last Name" required>
                    </div>
                    <br>

                    <div class="form-group">
                        <label for="additional_phone">Additional Phone Number:</label>
                        <input type="text" class="form-control" id="additional_phone" name="additional_phone" placeholder="Enter your Additional Phone Number">
                    </div>

                </div>
            </div>
            <br>

            <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Enter your Address" required>
                    </div>
                    <br>

                    <div class="form-group">
                        <label for="additional_info">Additional Information:</label>
                        <input type="text" class="form-control" id="additional_info" name="additional_info" placeholder="Enter Additional Information">
                    </div>
                    <br>

                    <div class="col-md-6">

            <div class="form-group">
                <label for="city">City:</label>
                <select class="form-control" id="city" name="city" required>
                    <option value="Cairo">Cairo</option>
                    <option value="Alexandria">Alexandria</option>
                    <option value="Giza">Giza</option>
                    <option value="Luxor">Luxor</option>
                    <option value="Aswan">Aswan</option>
                    <option value="Hurghada">Hurghada</option>
                    <option value="Sharm El Sheikh">Sharm El Sheikh</option>
                    <option value="Mansoura">Mansoura</option>
                </select>
            </div>
</div>

            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="set_default" name="set_default">
                <label class="form-check-label" for="set_default">Set as Default Address</label>
            </div>

            <button type="submit" class="btn btn-primary">Save Address</button>
        </form>
    </div>
</body>

</html>
