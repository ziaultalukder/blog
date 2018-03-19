<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sideber.php';?>
<?php
if(isset($_GET['msgid'])){
    echo $id = $_GET['msgid'];
}
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>View Message</h2>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo "<script>window.location='inbox.php';</script>";
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
                            <td><label>Name</label></td>
                            <td><input type="text" readonly value="<?php echo $result['firstname'].' '.$result['lastname']; ?>" class="medium" /></td>
                        </tr>

                        <tr>
                            <td><label>Email</label></td>
                            <td><input type="text" readonly value="<?php echo $result['email']; ?>" class="medium" /></td>
                        </tr>

                        <tr>
                            <td><label>Date</label></td>
                            <td><input type="text" readonly value="<?php echo $formate->fromatedate($result['date']); ?>" class="medium" /></td>
                        </tr>

                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                            <label>Message</label></td>
                            <td><textarea class="tinymce" name="body" readonly>
                                <?php echo $result['details']; ?>
                            </textarea></td>
                        </tr>

						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="OK" />
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
