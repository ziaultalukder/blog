<?php include_once 'inc/header.php';?>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){

		$fname = $formate->validation($_POST['firstname']);
		$lname = $formate->validation($_POST['lastname']);
		$email = $formate->validation($_POST['email']);
		$details = $formate->validation($_POST['details']);

		$fname = mysqli_real_escape_string($db->link, $fname);
		$lname = mysqli_real_escape_string($db->link, $lname);
		$email = mysqli_real_escape_string($db->link, $email);
		$details = mysqli_real_escape_string($db->link, $details);

		$error = "";
		if(empty($fname)){
			$error = "Please Input Your First Name!";
		}elseif(empty($lname)){
			$error = "Please Input Your Last Name!";
		}elseif(empty($email)){
			$error = "Please Input Your Email!";
		}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$error = "Please Input Valid Email!";
		}elseif(empty($details)){
			$error = "Please Input Your Message!";
		}else{
			$query = "INSERT INTO contact (firstname,  lastname, email, details) 
            VALUES('$fname','$lname', '$email', '$details')";

            $inserted_rows = $db->insert($query);

            if ($inserted_rows){
             $msg = "Message Send Success";
            }
            else{
             $error = "Please Input Your Message!";
            }
		}
}
?>
	<main class="main_section">
	
		<div class="maim-left clear">
			<div class="contact">
				<h3>Contact Me</h3>
				<?php
				if(isset($error)){
					echo "<span style='color:red'>$error</span>";
				}
				if(isset($msg)){
					echo "<span style='color:green'>$msg</span>";
				}

				?>
				<form action="" method="post">
					<table>
						<tr>
							<td>First Name	:	</td>
							<td><input type="text" name="firstname" placeholder="Enter Your First Name"></td>
						</tr>
						
						<tr>
							<td>Last Name	:	</td>
							<td><input type="text" name="lastname" placeholder="Enter Your Last Name"></td>
						</tr>
						
						<tr>
							<td>Your Email	:	</td>
							<td><input type="text" name="email" placeholder="Enter Your Email"></td>
						</tr>
						
						<tr>
							<td>Message	:	</td>
							<td><textarea name="details"></textarea></td>
						</tr>
						<tr>
							<td> </td>
							<td><input type="submit" name="btn" value="Submit"></td>
						</tr>
					</table>
				</form>
			</div>			

		</div>
		
		<?php include_once 'inc/sideber.php';?>
		
	</main>
	<?php include_once 'inc/footer.php';?>

