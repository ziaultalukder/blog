<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sideber.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>

<?php
if(isset($_GET['delcat'])){
	$id = $_GET['delcat'];

	$query = "delete from catagory where id=".$id;
	if($db->delete($query)){
		echo '<span style="color:green; font-size:18px;">Catagory Deleted Successfully</span>';
	}
	else{
		echo '<span style="color:red; font-size:18px;">Catagory Deleted Not Successfully</span>';
	}
}
?>

                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
<?php
$query = "SELECT * FROM catagory ORDER BY id DESC";
$catagory = $db->select($query);
if($catagory){
	$i=0;
	while($result = $catagory->fetch_assoc()){
		$i++;
?>

						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $result['name'];?></td>
							<td><a href="editcat.php?catid=<?php echo $result['id'];?>">Edit</a> ||
							<a onclick="return confirm('Are You Sure You Want To Delete');" href="?delcat=<?php echo $result['id'];?>">Delete</a></td>
						</tr>
<?php } } ?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">

	$(document).ready(function () {
		setupLeftMenu();

		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include_once 'inc/footer.php';?> 











