
<div class="slidersection clear">
	<div id="slider">
	<?php
		$query = "select * from slider order by id desc limit 5";
		$slider = $db->select($query);
		if($slider){
			while($result = $slider->fetch_assoc()){
	?>
        <a href="#"><img src="admin/<?php echo $result['image'];?>" alt="<?php echo $result['title'];?>" title="<?php echo $result['title'];?>" /></a>
        <?php } } ?>
    </div>
</div>
