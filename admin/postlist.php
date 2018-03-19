<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sideber.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="5%">SL</th>
							<th width="15%">Post Title</th>
							<th width="15%">Description</th>
							<th width="10%">Category</th>
							<th width="10%">Image</th>
							<th width="10%">Author</th>
							<th width="10%">Tags</th>
							<th width="15%">Date</th>
							<th width="10%">Action</th>
						</tr>
					</thead>
					<tbody>
<?php
if(isset($_GET['delpost'])){
	$id = $_GET['delpost'];
	$query = "delete from post where id=".$id;
	if($db->delete($query)){
		echo '<span style="color:green; font-size:18px;">Post Deleted Successfully</span>';
	}
	else{
		echo '<span style="color:red; font-size:18px;">Post Deleted Not Successfully</span>';
	}
}

?>

<?php
$query = "SELECT post.*, catagory.name FROM post INNER JOIN catagory ON post.catid=catagory.id ORDER BY post.title DESC";
$post = $db->select($query);
if($post){
	$i=0;
	while($result = $post->fetch_assoc()){
		$i++;
?>

				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['title']; ?></td>
					<td><?php echo $formate->textShorten($result['details'], 60)?></td>
					<td><?php echo $result['name']; ?></td>
					<td><img src="<?php echo $result['image']; ?>" height="50" width="60"></td>
					<td><?php echo $result['author']; ?></td>
					<td><?php echo $result['tags']; ?></td>
					<td class="center"><?php echo $formate->fromatedate($result['time'])?></td>
					<td>
						<a href="viewpost.php?viewid=<?php echo $result['id'];?>">View</a> 
						<?php if(Session::get('userId') == $result['userid'] || Session::get('userRole') == '0'){?>

						|| <a href="editpost.php?postid=<?php echo $result['id'];?>">Edit</a> ||
						<a onclick="return confirm('Are You Sure You Want To Delete');" href="?delpost=<?php echo $result['id'];?>">Delete</a>
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