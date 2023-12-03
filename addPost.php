<?php
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "db1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = sanitizeInput($_POST["title"]);
    $content = sanitizeInput($_POST["content"]);
    $ingredients = sanitizeInput($_POST["ingredients"]);
    $instructions = sanitizeInput($_POST["instructions"]);
    $isVegetarian = isset($_POST["isVegetarian"]) ? 1 : 0; // Check if the checkbox is checked
    $sql = "INSERT INTO blog_posts (title, content, ingredients, instructions, is_vegetarian) VALUES ('$title', '$content', '$ingredients', '$instructions', $isVegetarian)";

    if ($conn->query($sql) === TRUE) {
        echo '<div class="alert alert-success" role="alert">Blog post added successfully!</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Error: ' . $sql . '<br>' . $conn->error . '</div>';
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Blog Post</title>
    <link rel="stylesheet" href="bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<nav class="navbar navbar-expand-lg nb_custom">
        <div class="container-fluid">
          <a class="navbar-brand title_font" href="#">Title</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Dropdown
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" aria-disabled="true">Disabled</a>
              </li>
            </ul>
            <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
    </nav>

    <div class="container">
        <h2>Add a New Blog Post</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="title">Title:</label>
            <input type="text" name="title" class="form-control" required>
            <br>
            <label for="content">Content:</label>
            <textarea name="content" class="form-control" rows="4" required></textarea>
            <br>
            <label for="ingredients">Ingredients:</label>
            <textarea name="ingredients" class="form-control" rows="4" required></textarea>
            <br>
            <label for="instructions">Instructions:</label>
            <textarea name="instructions" class="form-control" rows="4" required></textarea>
            <br>
            <label>Is it Vegetarian?</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="isVegetarian">
                <label class="form-check-label" for="isVegetarian">Vegetarian</label>
            </div>
            <br>
            <button type="submit" class="btn btn-outline-success">Add Post</button>
        </form>
    </div>

    <!-- Your additional content, like buttons and card, can be added here -->

    <script text="text/javascript" src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
