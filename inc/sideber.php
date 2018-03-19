<div class="main-right clear">
			<div class="sameright-sight">
				<h2>Catagories</h2>
				<ul>
				<?php
					$query = "select * from catagory";
					$catagory = $db->select($query);
					if($catagory){
						while($result = $catagory->fetch_assoc()){
					?>
					<li><a href="posts.php?catagory=<?php echo $result ['id'];?>"><?php echo $result ['name'];?></a></li>

<?php } } else{ ?>
<li>No Catagory Here</li>
<?php }?>

				</ul>
			</div>
			
			<div class="sameright-sight">
				<h2>Popular Post</h2>
				<div class="popular-post">
				<?php
				$query="select * from post order by id desc limit 0,3";
				$post = $db->select($query);
				if($post){
					while($result = $post->fetch_assoc()){
				?>



					<h3><a href="post.php?id=<?php echo $result['id']?>"><?php echo $result['title']?></a></h3>
					<a href="post.php?id=<?php echo $result['id']?>"><img src="admin/<?php echo $result['image']?>" alt=""/></a>
					<p><?php echo $formate->textShorten($result['details'], 120)?></p>



<?php } } else{ header("Location:404.php");} ?>
				</div>
				
				
			</div>
			
			
		</div>