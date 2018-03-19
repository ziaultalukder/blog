<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sideber.php';?>
<?php
if(isset($_GET['replayid'])){
    echo $id = $_GET['replayid'];
}
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>View Message</h2>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $toEmail   = $formate->validation($_POST['toEmail']);
    $fromEmail = $formate->validation($_POST['fromEmail']);
    $subject   = $formate->validation($_POST['subject']);
    $message   = $formate->validation($_POST['message']);

    $senmail = mail($toEmail, $subject, $message, $fromEmail);
    if($senmail){
        echo '<span style="color:green; font-size:18px;">Message Send Succefully</span>';
    }
    else{
        echo '<span style="color:red; font-size:18px;">Something Went Wrong</span>';
    }
}
?>

                <div class="block">  
                <?php 
                $query = "select * from contact where id=".$id;
                $masid = $db->select($query);
                if($masid){
                    while($result = $masid->fetch_assoc()){
                ?>             
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                        <tr>
                            <td><label>To</label></td>
                            <td><input type="text" name="toEmail" readonly value="<?php echo $result['email']; ?>" class="medium" /></td>
                        </tr>

                        <tr>
                            <td><label>From </label></td>
                            <td><input type="text" name="fromEmail" placeholder="Please Enter Your Email Address" class="medium" /></td>
                        </tr>

                        <tr>
                            <td><label>Subject </label></td>
                            <td><input type="text" name="subject" placeholder="Please Enter Your Subject" class="medium" /></td>
                        </tr>

                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                            <label>Message</label></td>
                            <td><textarea class="tinymce" name="message">
                                
                            </textarea></td>
                        </tr>

						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Send" />
                            </td>
                        </tr>

                    </table>
                    </form>
                    <?php } } ?>
                </div>
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
