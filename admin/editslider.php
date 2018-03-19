<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sideber.php';?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Post</h2>
<?php
if(isset($_GET['sliderid'])){
    $id = $_GET['sliderid'];
}

?>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $title   = $_POST['title'];
    $title   = mysqli_real_escape_string($db->link, $title);

    $permited  = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "upload/slider/".$unique_image;

    if($title == ""){
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
            $query = "UPDATE slider 
                SET
                title   = '$title',
                image   = '$uploaded_image'
                 WHERE id=".$id;
            $updated_rows = $db->update($query);
            if ($updated_rows) 
            {
                 echo '<script>window.location = "sliderlist.php"</script>';
            }
            else 
            {
             echo "<span class='error'>Post Not Updated !</span>";
            }
        }
    }
    else
    {
        $query = "UPDATE slider SET title   = '$title' WHERE id=".$id;
            $updated_rows = $db->update($query);
            if ($updated_rows) 
            {
                echo '<script>window.location = "sliderlist.php"</script>';
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
$query = "select * from slider where id=".$id;
$slider  = $db->select($query);
if($slider){
    while($sliderresult = $slider->fetch_assoc()){
?>

                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td><label>Title</label></td>
                            <td><input type="text" name="title" 
                            value="<?php echo $sliderresult['title'];?>" class="medium" /></td>
                        </tr>

                        <tr>
                            <td><label>Upload Image</label></td>
                            <td>
                            <img src="<?php echo $sliderresult['image'];?>" height="150px;" width="350px;"><br/>
                            <input type="file" name="image" /></td>
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
