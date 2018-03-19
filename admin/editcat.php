<?php
if(isset($_GET['catid'])){
	$id = $_GET['catid'];
}
?>
<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sideber.php';?>
<div class="grid_10">

	<div class="box round first grid">
		<h2>Update Category</h2>
	   <div class="block copyblock">
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$name = $_POST['name'];
	$name = mysqli_real_escape_string($db->link, $name);

	$query="UPDATE catagory SET name='$name' WHERE id=".$id;

if(!empty($name)){
	if($db->update($query)){
		echo '<script>window.location = "catlist.php"</script>';
	}
}
else{
		echo '<span style="color:red; font-size:18px;">Update Not Success....</span>';
	}

}
?>



<?php
$query = "select * from catagory where id=".$id;
$catagory = $db->select($query);
if($catagory){
	while($result = $catagory->fetch_assoc()){

?>
		 <form action="" method="post">
			<table class="form">					
				<tr>
					<td>
						<input type="text" name="name" value="<?php echo $result['name'];?>" class="medium" />
					</td>
				</tr>
				<tr> 
					<td>
						<input type="submit" name="submit" Value="Save" />
					</td>
				</tr>
			</table>
			</form>
<?php } } ?>
		</div>
	</div>
<?php include_once 'inc/footer.php';?>       
