<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sideber.php';?>
<?php
if(!Session::get('userRole') == '0'){
    echo "<script>window.location='index.php';</script>";
}
?>
<div class="grid_10">

	<div class="box round first grid">
		<h2>Add New Category</h2>
	   <div class="block copyblock">
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){

	$username = $formate->validation($_POST['username']);
	$password = $formate->validation(md5($_POST['password']));
	$email    = $formate->validation($_POST['email']);
	$role     = $formate->validation($_POST['role']);

	$username = mysqli_real_escape_string($db->link, $username);
	$password = mysqli_real_escape_string($db->link, $password);
	$email    = mysqli_real_escape_string($db->link, $email);
	$role     = mysqli_real_escape_string($db->link, $role);

	if(empty($username) || empty($password) || empty($role) || empty($email)){
		echo '<span style="color:red; font-size:18px;">Field Must Not Be Empty!!</span>';
	}else{
	
		$query = "SELECT * FROM user WHERE email='$email' LIMIT 1";
		$mailcheck = $db->select($query);
		if($mailcheck != false){
			echo '<span style="color:red; font-size:18px;">Email Already Exist.</span>';
		}else{
			$query="INSERT INTO user(username, password, role) VALUES('$username', '$password', '$role')";
			$userrole = $db->insert($query);
			if($userrole){
				echo '<span style="color:green; font-size:18px;">User Created Success.</span>';
			}else{
				echo '<span style="color:red; font-size:18px;">User Not Created .</span>';
			}
				
		}
	}
}
?>


		 <form action="" method="post">
			<table class="form">					
				<tr>
					<td><label>User Name</label></td>
					<td><input type="text" name="username" placeholder="Enter Username Name..." class="medium" /></td>
				</tr>

				<tr>
					<td><label>Email</label></td>
					<td><input type="email" name="email" placeholder="Enter Email Here..." class="medium" /></td>
				</tr>

				<tr>
					<td><label>Password</label></td>
					<td><input type="text" name="password" placeholder="Enter Password Name..." class="medium" /></td>
				</tr>

				<tr>
					<td><label>User Role</label></td>
					<td>
						<select name="role">
							<option>Select Role</option>
							<option value="0">Admin</option>
							<option value="1">Editor</option>
							<option value="2">Author</option>
						</select>
					</td>
				</tr>

				<tr>
					<td></td> 
					<td><input type="submit" name="submit" Value="Create" /></td>
				</tr>
			</table>
			</form>

		</div>
	</div>
<?php include_once 'inc/footer.php';?>       