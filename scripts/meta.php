<?php
if(isset($_GET['pageid'])){
	$pageid = $_GET['pageid'];
	$query = "select * from page where id=".$pageid;
	$pagetitle = $db->select($query);
	if($pagetitle){
		while($result = $pagetitle->fetch_assoc()){ 
?>
<title><?php echo $result['name'];?>-<?php echo TITLE;?></title>
<?php } } } elseif(isset($_GET['id'])){
$postid = $_GET['id'];
$query = "select * from post where id=".$postid;
$posttitle = $db->select($query);
if($posttitle){
	while($result = $posttitle->fetch_assoc()){ 
?>
<title><?php echo $result['title'];?>-<?php echo TITLE;?></title>
<?php } } }else{?>
<title><?php echo $formate->title();?>-<?php echo TITLE;?></title>
<?php }?>




<meta name="language" content="english, bangla">
<meta name="description" content="It was an e-commerce and online magazine">

<?php
if(isset($_GET['id'])){
	$keywordsid = $_GET['id'];
	$query = "select * from post where id=".$keywordsid;
	$keywords = $db->select($query);
	if($keywords){
		while($result = $keywords->fetch_assoc()){?>
	<meta name="keywords" content="<?php echo $result['tags']; ?>">	
<?php } }?>
<?php } else{?> 
<meta name="keywords" content="<?php echo  KEYWORDS ; ?>">
<?php }?>



<meta name="author" content="Ziaul Talukder	">