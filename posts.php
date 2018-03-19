<?php include_once 'inc/header.php';?>
<?php include_once 'inc/slider.php';?>
<main class="main_section">
	


<?php
if(!isset($_GET['catagory']) || $_GET['catagory'] == NULL){
	header("Location:404.php");
}
else{
	$id = $_GET['catagory'];
}
?>






	
<div class="maim-left clear">



<?php

$query=" select * from post where catid=".$id;
$catagory = $db->select($query);
if($catagory){
	while ($result = $catagory->fetch_assoc()) {
		
?>


<div class="single-post clear">
	<a href="post.php?id=<?php echo $result['id']?>"><h2><?php echo $result['title']?></h2></a>
	<h3><?php echo $formate->fromatedate($result['time'])?> By <a href=""><?php echo $result['author']?></a></h3>
	<a href=""><img src="admin/<?php echo $result['image']; ?>" alt=""/></a>

	<p><?php echo $formate->textShorten($result['details'])?></p>

	 <div class="readmore clear">
		<a href="post.php?id=<?php echo $result['id']?>">Read More</a>
	 </div>
</div>

<?php }?> <!-- end while loop -->



<?php } else {?>
<h3>No Post Available In This Catagory</h3>
<?php }?>		
		</div>
		<?php include_once 'inc/sideber.php';?>
		
	</main>
	<?php include_once 'inc/footer.php';?>