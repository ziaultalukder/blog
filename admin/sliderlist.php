<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sideber.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Slider List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>SL</th>
							<th>Slider Title</th>
							<th>Slider Image</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
<?php
if(isset($_GET['delslider'])){
	$id = $_GET['delslider'];
	$query = "delete from slider where id=".$id;
	if($db->delete($query)){
		echo '<span style="color:green; font-size:18px;">Slider Deleted Successfully</span>';
	}
	else{
		echo '<span style="color:red; font-size:18px;">Slider Deleted Not Successfully</span>';
	}
}

?>

<?php
$query = "SELECT * FROM slider ";
$slider = $db->select($query);
if($slider){
	$i=0;
	while($result = $slider->fetch_assoc()){
		$i++;
?>

				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['title']; ?></td>
					<td><img src="<?php echo $result['image']; ?>" height="150" width="350"></td>
					<td> 
						<?php if( Session::get('userRole') == '0'){?>
						<a href="editslider.php?sliderid=<?php echo $result['id'];?>">Edit</a>
						|| <a onclick="return confirm('Are You Sure You Want To Delete');" href="?delslider=<?php echo $result['id'];?>">Delete</a>
						<?php }?>
					</td>
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