<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sideber.php';?>
<div class="grid_10">

	<div class="box round first grid">
		<h2>Add New Category</h2>
	   <div class="block copyblock">
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$name = $_POST['name'];
	$name = mysqli_real_escape_string($db->link, $name);

	$query="INSERT INTO catagory(name) VALUES('$name')";

if(!empty($name)){
	if($db->insert($query)){
		echo '<span style="color:green; font-size:18px;">Catagory Added Success.</span>';
	}
}
else{
		echo '<span style="color:red; font-size:18px;">Field Must Not Be Empty.</span>';
	}

}
?>


		 <form action="" method="post">
			<table class="form">					
				<tr>
					<td>
						<input type="text" name="name" placeholder="Enter Category Name..." class="medium" />
					</td>
				</tr>
				<tr> 
					<td>
						<input type="submit" name="submit" Value="Save" />
					</td>
				</tr>
			</table>
			</form>

		</div>
	</div>
<?php include_once 'inc/footer.php';?>       