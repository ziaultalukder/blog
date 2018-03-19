<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sideber.php';?>
<style type="text/css">
    .actiondel{margin-left: 20px;}
    .actiondel a{
    border: 1px solid #ddd;
    color: #444;
    cursor: pointer;
    font-size: 20px;
    padding: 2px 10px;
    font-weight: normal;
    background-color: #F0F0F0;
}
</style>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Post</h2>

<?php
if(isset($_GET['pageid'])){
    $id = $_GET['pageid'];
}
?>

<?php
if(isset($_GET['delpage'])){
    $id = $_GET['delpage'];
    $query = "DELETE FROM page WHERE id=".$id;
    $delpage = $db->delete($query);
    if($delpage){
        echo '<span style="color:green; font-size:18px;">Page Deleted Successfully</span>';
        echo '<script>window.location= index.php ;</script>';
    }else{
        echo '<span style="color:red; font-size:18px;">Page Deleted Not Successfully</span>';
    }

}
?>


<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $name = $_POST['name'];
    $body = $_POST['body'];

    $name   = mysqli_real_escape_string($db->link, $name);
    $body = mysqli_real_escape_string($db->link, $body);   

    if( $name == "" || $body == ""){
        echo '<span style="color:red; font-size:18px;">Field Must Not Be Empty.</span>';   
    }
    else
    {
            $query="UPDATE page SET 
            name='$name',
            body='$body'
             WHERE id=".$id;

            $inserted_rows = $db->update($query);

            if ($inserted_rows){
             echo "<span class='success'>Page Updated Successfully.
             </span>";
            }
            else{
             echo "<span class='error'>Page Not Updated Inserted !</span>";
            }
    }
        
}
else{
    $query = "select * from page where id=".$id;
    $pages = $db->select($query);
    if($pages){
        while ($result = $pages->fetch_assoc()) {
            
?>

                <div class="block">               
                 <form action="" method="post">
                    <table class="form">
                       
                        <tr>
                            <td><label>Title</label></td>
                            <td><input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium" /></td>
                        </tr>

                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label></td>
                            <td><textarea class="tinymce" name="body">
                                <?php echo $result['body']; ?>
                            </textarea></td>
                        </tr>

						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                                <span class="actiondel"><a onclick="return confirm('Are You Sure You Want To Delete Page !!!');" href="?delpage=<?php echo $result['id']?>">Delete</a></span>
                            </td>
                        </tr>

                    </table>
                    </form>
                </div>
<?php } } } ?>

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
