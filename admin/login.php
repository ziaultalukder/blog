<?php
include_once '../lib/Session.php';
Session::checkLogin();
?>
<?php include_once '../config/config.php';?>
<?php include_once '../lib/Database.php';?>
<?php include_once '../helpers/Formate.php';?>
<?php
	$db = new Database();
	$formate = new Formate();
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
	<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$username = $formate->validation($_POST['username']);
		$password = $formate->validation(md5($_POST['password']));

		$username = mysqli_real_escape_string($db->link, $username);
		$password = mysqli_real_escape_string($db->link, $password);

		$query = "select * from user where username='$username' and password='$password'";
		$result = $db->select($query);
		if($result != false){
			//$value = mysqli_fetch_array($result);
			$value = $result->fetch_assoc();
				Session::set("login", true);
				Session::set("username", $value['username']);
				Session::set("userId", $value['id']);
				Session::set("userRole", $value['role']);
				header("Location:index.php");
		}
		else{
				echo '<span style="color:red; font-size:18px;">Username and Password Dose Not Mathc !!!</span>';
			}
	}

	?>
		<form action="" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Username"  name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password"  name="password"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->

		<div class="button">
			<a href="forgotpass.php">Forgot Password</a>
		</div><!-- button -->

		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>