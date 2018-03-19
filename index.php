<?php include_once 'inc/header.php';?>
<?php include_once 'inc/slider.php';?>
	<main class="main_section">
	

	
		<div class="maim-left clear">

<!-- start Pagination -->
<?php
$per_page = 3;
if(isset($_GET["page"])){
	$page = $_GET["page"];
}
else{
	$page = 1;
}

$start_from = ($page-1) * $per_page;

?>

<!-- end Pagination -->

<?php
$search = "";

if(isset($_POST['search'])){
	$search = $_POST['search'];
}



$query = "SELECT * FROM post ";
if($search != ""){
	$query .=" where (post.title like '%$search%') or post.details like '%$search%'";
}


$query.=" limit $start_from, $per_page";
$post = $db->select($query);
if($post){
	while ($result = $post->fetch_assoc()) {
		
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

<!-- start Pagination -->
<?php
$query  = "select * from post";
$result = $db->select($query);
$total_ros = mysqli_num_rows($result);
$total_page = ceil($total_ros/$per_page);


?>



<?php
echo "<span class='pagination'><a href='index.php?page=1'>".'First Page'."</a>";

for ($i=1; $i<=$total_page; $i++) { 
	echo "<a href='index.php?page=".$i."'>".$i."</a>";
}

echo "<a href='index.php?page=$total_page'>".'Last Page'."</a></span>";
?>

<!-- end Pagination  -->




<?php } else{header("Location:404.php");}?>		
</div>
<?php include_once 'inc/sideber.php';?>

</main>
<?php include_once 'inc/footer.php';?>
