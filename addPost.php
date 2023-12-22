<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Add Post</title>
	<?php include 'includes_and_requires/menu.php'?>
	<?php include 'includes_and_requires/bootstrap.php' ?>
	<?php require 'styleTemp.php'?>
</head>
<script>
	var count = 1;
	function addInput(){
		var input = document.createElement("input");
		input.setAttribute("type","text");
		input.setAttribute("name","item"+count);
		input.setAttribute("placeholder","Item"+count)
		document.getElementById("ing").appendChild(input)
		var br = document.createElement("br");
		document.getElementById("ing").appendChild(br)
		document.getElementById("ing").appendChild(br)
		
		document.getElementById("num").setAttribute("value",count);
		count++;
		}
</script>
<body>
	<div id="addPostPage">
		<div class="img_post"></div>
	<div class="form">
		<form action="InsertController.php">
			<label for="ing">Ingredients</label>
			<div id="ing"></div>
			<label for="img">Add Image: </label>
			<br>
			<input type="file" name="img_url">
			<br>
			<label for="title">Title: </label>
			<input type="text" name="title">
			<br>
			<label for="desc">Description: </label>
			<br>
			<textarea name="desc" cols="50" rows="5"></textarea>
			<br>
			<label for="img">Vegeterian?: </label>
			<br>
			<input type="radio" name="is_veg" value="1">
			<label for="1">Yes</label>
			<input type="radio" name="is_veg" value="0">
			<label for="0">No</label>
			<br>
			<input type="submit" value="add post">
			<input type="hidden" name="hide" value="3">
			<input type="hidden" name="numIng"  id ="num" value="0">
		</form>
		<br>
		<button onclick="addInput()">Add An Ingredient</button>
	</div>
	<div class="formImg"></div>
	</div>
</body>
</html>