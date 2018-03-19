<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sideber.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>

<?php
if(isset($_GET['deluser'])){
	$id = $_GET['deluser'];

	$query = "delete from user where id=".$deluser;
	if($db->delete($query)){
		echo '<span style="color:green; font-size:18px;">User Deleted Successfully</span>';
	}
	else{
		echo '<span style="color:red; font-size:18px;">User Deleted Not Successfully</span>';
	}
}
?>

                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>SL</th>
							<th>Name</th>
							<th>UserName</th>
							<th>Email</th>
							<th>Details</th>
							<th>Role</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
<?php
$query = "SELECT * FROM user ORDER BY id DESC";
$userlist = $db->select($query);
if($userlist){
	$i=0;
	while($result = $userlist->fetch_assoc()){
		$i++;
?>

						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $result['name'];?></td>
							<td><?php echo $result['username'];?></td>
							<td><?php echo $result['email'];?></td>
							<td><?php echo $formate->textShorten($result['details'], 30);?></td>
							<td>
							<?php
							if($result['role'] == '0'){
								echo "Admin";
							}elseif($result['role'] == '1'){
								echo "Editor";
							}elseif($result['role'] == '2'){
								echo "Author";
							}
							?>
								
							</td>
							<td>
							<a href="viewuser.php?userid=<?php echo $result['id'];?>">View</a> 
							 <?php if(Session::get('userRole') == '0'){?>
							 ||<a onclick="return confirm('Are You Sure You Want To Delete');" href="?deluser=<?php echo $result['id'];?>">Delete</a>
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











