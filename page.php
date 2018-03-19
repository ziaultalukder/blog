<?php include_once 'inc/header.php';?>
<?php
if(!isset($_GET['pageid']) || $_GET['pageid'] ==NULL ){
	header("Location:404.php");
}else{
	$id = $_GET['pageid'];	
}
?>

	<main class="main_section">
		<div class="maim-left clear">
			<div class="about">
			<?php
			$query = "select * from page where id=".$id;
			$pages = $db->select($query);
			if($pages){
				while($result = $pages->fetch_assoc()){

			?>
				<h3><?php echo $result['name']; ?></h3>
				<img src="img/C9OW18UUwAABc9g.jpg" alt="My Image">
				<p><?php echo $result['body']; ?></p>

			<?php } } else{header("Location:404.php"); } ?>
			</div>

		</div>
		
		<?php include_once 'inc/sideber.php';?>

	</main>
	<?php include_once 'inc/footer.php';?>