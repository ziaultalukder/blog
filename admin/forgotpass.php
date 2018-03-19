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
<title>Forgot Password</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
	<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$email = $formate->validation($_POST['email']);
		$email = mysqli_real_escape_string($db->link, $email);

		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			echo '<span style="color:red; font-size:18px;">Invalid Email Address!</span>';
		}else{

		$query = "SELECT * FROM user WHERE email='$email' LIMIT 1";
		$mailcheck = $db->select($query);
		if($mailcheck != false){
			while ($value = $mailcheck->fetch_assoc()) {
				$userid = $value['id'];
				$username = $value['username'];
			}
			$text = substr($email, 0, 4);
			$rand = rand(10000, 99999);
			$newpass = "$text$rand";
			$password = md5($newpass);

			$updatequery = "update set user password='$password' where id='$userid'";
			$updated_row = $db->update($updatequery);


			$to = "$email";
			$form = "kinoobd@gmail.com";
			$headers = "Form : $form\n";
			$headers .= "MIME-Version: 1.0\n" ;
        	$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
        	$subject = "Your Password";
        	$message = "Your username is =".$username." and your password is =".$newpass." Please visit to website to login!";

			$sentmail = mail($to, $subject, $message,$headers);
			if($sentmail){
				echo '<span style="color:green; font-size:18px;">Please Check Your Email</span>';
			}else{
				echo '<span style="color:red; font-size:18px;">Email Not Send!</span>';
			}
		}
		else{
			echo '<span style="color:red; font-size:18px;">Email Not Exist!</span>';
		}
	}
}

?>
		<form action="" method="post">
			<h1>Password Recovery</h1>
			<div>
				<input type="text" name="email" placeholder="Enter Your Email"/>
			</div>
			<div>
				<input type="submit" value="Send Mail" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="login.php">Log In</a>
		</div><!-- button -->

		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>