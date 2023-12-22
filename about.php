<?php
include 'db_connect.php';
include 'header.php';
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM posts where id=".$_GET['id']);
	foreach ($qry->fetch_array() as $key => $value) {
		$meta[$key] = $value;
	}
}
?>
<div class="container">
	<div class="col-md-12">
		<?php echo html_entity_decode($meta['about']) ?>
	</div>
</div>