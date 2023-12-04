<?php
include 'config.php';

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

    $sql = "INSERT INTO blog_posts (title, content, ingredients, instructions, is_vegetarian) 
            VALUES ('$title', '$content', '$ingredients', '$instructions', $isVegetarian)";

    if ($conn->query($sql) === TRUE) {
        echo '<div class="alert alert-success" role="alert">Blog post added successfully!</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Error: ' . $sql . '<br>' . $conn->error . '</div>';
    }
}

$conn->close();
?>
