<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sideber.php';?>
        <div class="grid_10">
            <div class="box round first grid">
            <?php
            if(isset($_GET['seenid'])){
            	$seenid = $_GET['seenid'];
            	$query = "UPDATE contact SET status = '1' WHERE id=".$seenid;
	            $updated_rows = $db->update($query);

	            if ($updated_rows){
	             echo '<span style="color:green; font-size:18px;">Message Sent To Seen Box.</span>';
	            }
	            else{
	             echo '<span style="color:green; font-size:18px;">Something Went Wrong.</span>';
	            }
            }

            ?>
                <h2>Inbox</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>SL No</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Time</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

					<?php
						$query = "SELECT * FROM contact WHERE status='0' ORDER BY id DESC";
						$msg = $db->select($query);
						if($msg){
							$i=0;
							while($result = $msg->fetch_assoc()){
								$i++;
					?>

						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['firstname'].' '.$result['lastname']; ?></td>
							<td><?php echo $result['email']; ?></td>
							<td><?php echo $formate->textShorten($result['details'], 30 ); ?></td>
							<td><?php echo $formate->fromatedate($result['date']); ?></td>
							<td>
							<a href="viewmsg.php?msgid=<?php echo $result['id']?>">View</a> ||
							<a href="replay.php?replayid=<?php echo $result['id']?>">Replay</a> ||
							<a onclick="return confirm('Are You Sure You Sent Message Seen Box');" href="?seenid=<?php echo $result['id']?>">Seen</a></td>
						</tr>
						<?php } } ?>
					</tbody>
				</table>
               </div>
            </div>




            <div class="box round first grid">
                <h2>Seen Message</h2>
<?php
	if(isset($_GET['delid'])){
		$delid = $_GET['delid'];
		$query = "delete from contact where id=".$delid;
		if($db->delete($query)){
			echo '<span style="color:green; font-size:18px;">Seen Message Deleted Successfully</span>';
		}else{
			echo '<span style="color:green; font-size:18px;">Seen Message Deleted Not Successfully</span>';
		}
	}
?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>SL No</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Time</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

					<?php
						$query = "SELECT * FROM contact WHERE status='1' ORDER BY id DESC";
						$msg = $db->select($query);
						if($msg){
							$i=0;
							while($result = $msg->fetch_assoc()){
								$i++;
					?>

						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['firstname'].' '.$result['lastname']; ?></td>
							<td><?php echo $result['email']; ?></td>
							<td><?php echo $formate->textShorten($result['details'], 30 ); ?></td>
							<td><?php echo $formate->fromatedate($result['date']); ?></td>
							<td>
							<a onclick="return confirm('Are You Sure You Wnat To Delete');" href="?delid=<?php echo $result['id']?>">Delete</a>
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