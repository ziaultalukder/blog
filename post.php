<?php include_once 'inc/header.php';?>
<?php
if(!isset($_GET['id']) || $_GET['id'] == NULL){
	header("Location:404.php");
}
else{
	$id = $_GET['id'];
}
?>
	<main class="main_section">
	
		<div class="maim-left clear">
			<div class="about">

<?php
$query = "select * from post where id=".$id;
$postdetails = $db->select($query);
if($postdetails){
	while($result = $postdetails->fetch_assoc()){
?>

				<h3><?php echo $result['title']; ?></h3>
				<h4><?php echo $formate->fromatedate($result['time'])?>, By <a href=""><?php echo $result['author']?></a></h4>

				<img src="admin/<?php echo $result['image']; ?>" alt=""/>

				<p><?php echo $result['details']; ?></p>

				
			</div>
			
			<div class="relatedpost clear">
			<h2>Related Post</h2>
			<?php
			$catid = $result['catid'];
			$catquery = "select * from post where catid='$catid' order by rand() limit 6";
			$catresult = $db->select($catquery);
			if($catresult){
				while ($relresult = $catresult->fetch_assoc()) {

			?>
				
				<a href="post.php?id=<?php echo $relresult['id']?>"><img src="admin/<?php echo $relresult['image']; ?>"></a>
				

			<?php } } else{ echo "No Related Post Here"; }?>
			</div>

<?php  } } else{header("Location:404.php"); }?>

		</div>
		
		<?php include_once 'inc/sideber.php';?>
	</main>
<?php include_once 'inc/footer.php';?>