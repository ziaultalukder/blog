<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sideber.php';?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Post</h2>
<?php
if(isset($_GET['postid'])){
    $id = $_GET['postid'];
}

?>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){


    $title   = $_POST['title'];
    $details = $_POST['details'];
    $catid   = $_POST['catid'];
    $author  = $_POST['author'];
    $tags    = $_POST['tags'];
    $userid  = $_POST['userid'];


    $catid   = mysqli_real_escape_string($db->link, $catid);
    $title   = mysqli_real_escape_string($db->link, $title);
    $details = mysqli_real_escape_string($db->link, $details);   
    $author  = mysqli_real_escape_string($db->link, $author);
    $tags    = mysqli_real_escape_string($db->link, $tags);
    $userid  = mysqli_real_escape_string($db->link, $userid);

    $permited  = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "upload/".$unique_image;

    if($catid == "" || $title == "" || $details == "" || $author == "" || $tags==""){
        echo '<span style="color:red; font-size:18px;">Field Must Not Be Empty.</span>';   
    }
    else{
    if(!empty($file_name)){
        if ($file_size >1048567) 
        {
         echo "<span class='error'>Image Size should be less then 1MB!</span>";
        } 

        elseif (in_array($file_ext, $permited) === false) 
        {
         echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
        } 

        else
        {
            
           
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "UPDATE post 
                SET
                catid   = '$catid',
                title   = '$title',
                image   = '$uploaded_image',
                details = '$details',
                author  = '$author',
                tags    = '$tags',
                userid  = '$userid'

                 WHERE id=".$id;


            $updated_rows = $db->update($query);

            if ($updated_rows) 
            {
             echo '<script>window.location = "postlist.php"</script>';
            }
            else 
            {
             echo "<span class='error'>Post Not Updated !</span>";
            }
        }
    }
    else
    {
        $query = "UPDATE post 
                SET
                catid   = '$catid',
                title   = '$title',
                details = '$details',
                author  = '$author',
                tags    = '$tags',
                userid  = '$userid'
                WHERE id=".$id;


            $updated_rows = $db->update($query);

            if ($updated_rows) 
            {
             echo '<script>window.location = "postlist.php"</script>';
            }
            else 
            {
             echo "<span class='error'>Post Not Updated !</span>";
            }
        }
    }

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
                            <td><input type="text" name="title" 
                            value="<?php echo $postresult['title'];?>" class="medium" /></td>
                        </tr>
                     
                        <tr>
                            <td><label>Category</label></td>
                            <td>
                                <select id="select" name="catid">
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
                            <input type="file" name="image" /></td>
                        </tr>

                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label></td>
                            <td><textarea class="tinymce" name="details">
                                <?php echo $postresult['details'];?>
                            </textarea></td>
                        </tr>

                        <tr>
                            <td><label>Author</label></td>
                            <td>
                                <input type="text" name="author" value="<?php echo $postresult['author'];?>" class="medium" />
                                <input type="hidden" name="userid" value="<?php echo Session::get("userId")?>" class="medium">
                            </td>
                        </tr>

                        <tr>
                            <td><label>Tags</label></td>
                            <td>
                                <input type="text" name="tags" 
                                value="<?php echo $postresult['tags'];?>" class="medium" />
                            </td>
                        </tr>

						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
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
