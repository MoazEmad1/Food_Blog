<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yumnet Message Page</title>
    <?php include 'includes_and_requires/bootstrap.php'?>
    <?php include 'styleTemp.php'?>
</head>
<body>
    <?php include 'includes_and_requires/menu.php'?>
    <p>
        Enter user name to start messaging:
    </p>
    <form action="Controllers/searchMController.php">
        <input type="text" name="user_name" >
        <input type="submit" value="Search">
    </form>
</body>
</html>