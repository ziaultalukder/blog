<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sideber.php';?>

<?php
    $userid   = Session::get('userId');
    $userRole = Session::get('userRole');
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update User</h2>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $details = $_POST['details'];

    $name     = mysqli_real_escape_string($db->link, $name);
    $username = mysqli_real_escape_string($db->link, $username);
    $email = mysqli_real_escape_string($db->link, $email);
    $details = mysqli_real_escape_string($db->link, $details);

    $query = "UPDATE user SET
             name = '$name',
             username = '$username',
             email = '$email',
             details = '$details'
             WHERE id=".$userid;
        $updated_rows = $db->update($query);

        if ($updated_rows){
         echo '<span style="color:green; font-size:18px;">User Information Updated Succefully</span>';
        }else{
         echo '<span style="color:red; font-size:18px;">User Information Updated Not Succefully</span>';
        }
    }
?>


<?php
$query   = "select * from user where id='$userid' and role='$userRole'";
$getuser = $db->select($query);
if($getuser){
    while($result = $getuser->fetch_assoc()){
?>
        <div class="block">
            <form action="" method="post">
                <table class="form">
                   
                    <tr>
                        <td><label>Name </label></td>
                        <td><input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium" /></td>
                    </tr>

                    <tr>
                        <td><label>Username </label></td>
                        <td><input type="text" name="username" value="<?php echo $result['username']; ?>" class="medium" /></td>
                    </tr>

                    <tr>
                        <td><label>Email </label></td>
                        <td><input type="email" name="email" value="<?php echo $result['email']; ?>" class="medium" /></td>
                    </tr>

                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                        <label>Content</label></td>
                        <td><textarea class="tinymce" name="details">
                            <?php echo $result['details']; ?>
                        </textarea></td>
                    </tr>
                	<tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
<?php } } ?>
    </div>
</div>
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<?php include_once 'inc/footer.php';?>
