<?php
include 'config.php';

// Select all blog posts from the database
$sql = "SELECT * FROM blog_posts";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Blog Posts</title>
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
        <h2>View Blog Posts</h2>
        
        <?php
        // Check if there are any posts
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo '<div class="card mb-3">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row["title"] . '</h5>';
                echo '<p class="card-text"><strong>Content:</strong> ' . $row["content"] . '</p>';
                echo '<p class="card-text"><strong>Ingredients:</strong> ' . $row["ingredients"] . '</p>';
                echo '<p class="card-text"><strong>Instructions:</strong> ' . $row["instructions"] . '</p>';
                echo '<p class="card-text"><strong>Vegetarian:</strong> ' . ($row["is_vegetarian"] ? 'Yes' : 'No') . '</p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>No blog posts found.</p>';
        }

        // Close the result set
        $result->free_result();
        ?>

    </div>

    <!-- Your additional content, like buttons and card, can be added here -->

    <script text="text/javascript" src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
