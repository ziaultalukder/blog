<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sideber.php';?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Post</h2>
<?php
if(isset($_GET['viewid'])){
    $id = $_GET['viewid'];
}

?>


                <div class="block">

<?php 
$query = "select * from post where id=".$id;
$post  = $db->select($query);
if($post){
    while($postresult = $post->fetch_assoc()){
?>

                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td><label>Title</label></td>
                            <td><input type="text" readonly 
                            value="<?php echo $postresult['title'];?>" class="medium" /></td>
                        </tr>
                     
                        <tr>
                            <td><label>Category</label></td>
                            <td>
                                <select id="select" readonly>
                                <option>Select Catagory </option>
                                <?php
                                $query = "select * from catagory";
                                $catagory = $db->select($query);
                                if($catagory){
                                    while($result = $catagory->fetch_assoc()){
                                ?>

                                    <option 
                                    <?php
                                    if($postresult['catid'] == $result['id']){ ?>

                                    selected="selected"
                                    
                                    <?php } ?>value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>

                                    <?php } } ?>
                                </select>
                            </td>
                        </tr>


                        <tr>
                            <td><label>Upload Image</label></td>
                            <td>
                            <img src="<?php echo $postresult['image'];?>" height="80px;" width="200px;"><br/>
                        </tr>

                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label></td>
                            <td><textarea class="tinymce" readonly>
                                <?php echo $postresult['details'];?>
                            </textarea></td>
                        </tr>

                        <tr>
                            <td><label>Author</label></td>
                            <td>
                                <input type="text" readonly value="<?php echo $postresult['author'];?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td><label>Tags</label></td>
                            <td>
                                <input type="text" readonly
                                value="<?php echo $postresult['tags'];?>" class="medium" />
                            </td>
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
