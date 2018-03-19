<?php include_once 'config/config.php';?>
<?php include_once 'lib/Database.php';?>
<?php include_once 'helpers/Formate.php';?>
<?php
	$db = new Database();
	$formate = new Formate();
?>

<!doctype html>
<html class="no-js" lang="">
    <head>
    	<?php include_once 'scripts/meta.php';?>
    	<?php include_once 'scripts/css.php';?>
    	<?php include_once 'scripts/js.php';?>
					
    </head>
    <body>

<div class="container clear">
	<header class="header_section">

<?php
	$query = "SELECT * FROM title_slogan WHERE id='1'";
	$title_slogan = $db->select($query);
	if($title_slogan){
	    while($result = $title_slogan->fetch_assoc()){
?>

		<a href="index.php">
			<div class="logo clear">
				<img src="admin/<?php echo $result['logo']; ?>" alt="Logo Image">
			</div>
		</a>
<?php } } ?>		
		<div class="socail clear">

<?php
	$query = "select * from social where id='1'";
	$socail = $db->select($query);
	if($socail){
	    while($result = $socail->fetch_assoc()){
?>  
			<a href="<?php echo $result['fb']; ?>"><i class="fa fa-facebook"></i></a>
			<a href="<?php echo $result['twter']; ?>"><i class="fa fa-twitter"></i></a>
			<a href="<?php echo $result['gd']; ?>"><i class="fa fa-google-plus-square"></i></a>
			<a href="<?php echo $result['ln']; ?>"><i class="fa fa-linkedin"></i></a>
<?php } }?>							
		</div>
	</header>
	
	<section class="nav-search">
		<nav class="nav_section">
			<ul>
			<?php
			$path = $_SERVER['SCRIPT_FILENAME'];
			$title = basename($path, '.php');
			?>
				<li><a 
				<?php if($title == 'index'){echo 'id="active"';}; ?>
				href="index.php">Home</a></li>
				

						<?php
	                        $query = "select * from page";
	                        $page = $db->select($query);
	                        if($page){
	                            while($result = $page->fetch_assoc()){
	                    ?>
						<li><a 
						<?php
						if(isset($_GET['pageid']) && $_GET['pageid'] == $result['id']){
							echo 'id="active"';
						}
						?>
						href="page.php?pageid=<?php echo $result['id']; ?>"><?php echo $result['name']?></a></li>
						<?php } } ?>



				<li><a 
				<?php if($title == 'contact_us'){echo 'id="active"';}; ?>
				href="contact_us.php">Contact Us</a></li>
			</ul>
		</nav>
		<div class="search clear">
			<form action="index.php" method="post">
				<input type="text" name="search" placeholder="Search Here.."/>
				<input type="submit" name="btn" value="Search" />
			</form>
		</div>
	</section>