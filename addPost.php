<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Blog Post</title>
    <!--<link rel="stylesheet" href="bootstrap-5.3.2-dist/css/bootstrap.min.css">-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light nb_custom">
    <div class="container-fluid">
      <a class="navbar-brand title_font" href="#">Food Recipes</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Recipes</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle selected" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              User Actions
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Profile</a></li>
              <li><a class="dropdown-item" href="addPost.php">Add Recipe</a></li>
            </ul>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success search" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
    <div class="container">
        <h2>Add a New Blog Post</h2>
        <form method="post" action="insert.php">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!--<script text="text/javascript" src="js/bootstrap.bundle.min.js"></script>-->
</body>
</html>
