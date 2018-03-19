<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sideber.php';?>
<style type="text/css">
    .left-side{float: left;width: 70%;}
    .right_sight{float: right; width: 20%; border: 1px solid black; height: 250px; margin-right: 20px;}
    .right_sight img{height: 100%; width: 100%;}
</style>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Site Title and Description</h2>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){


    $title = $_POST['title'];
    $slogan = $_POST['slogan'];

    $title = $formate->validation($_POST['title']);
    $slogan = $formate->validation($_POST['slogan']);

    $title   = mysqli_real_escape_string($db->link, $title);
    $slogan   = mysqli_real_escape_string($db->link, $slogan);

    $permited  = array('png');
    $file_name = $_FILES['logo']['name'];
    $file_size = $_FILES['logo']['size'];
    $file_temp = $_FILES['logo']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $same_image = 'logo'.'.'.$file_ext;
    $uploaded_image = "upload/".$same_image;

    if($slogan == "" || $title == "" ){
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
            $query = "UPDATE title_slogan 
                SET
                title = '$title',
                slogan = '$slogan',
                logo = '$uploaded_image'               
                 WHERE id='1'";
            $updated_rows = $db->update($query);

            if ($updated_rows) 
            {
             echo '<span style="color:green; font-size:18px;">Updated Successfully</span>';
            }
            else 
            {
             echo "<span class='error'>Post Not Updated !</span>";
            }
        }
    }
    else
    {
        $query = "UPDATE title_slogan 
                SET
                title = '$title',
                slogan = '$slogan'

                 WHERE id='1'";

            $updated_rows = $db->update($query);

            if ($updated_rows) 
            {
             echo '<span style="color:green; font-size:18px;">Updated Successfully</span>';
            }
            else 
            {
             echo "<span class='error'>Post Not Updated !</span>";
            }
        }
    }

}
?>



<?php
$query = "SELECT * FROM title_slogan WHERE id='1'";
$title_slogan = $db->select($query);
if($title_slogan){
    while($result = $title_slogan->fetch_assoc()){
?>
                <div class="block-sloginblock">
                <div class="left-side">
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Website Title</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['title']?>" name="title" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Website Slogan</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['slogan']?>" name="slogan" class="medium" />
                            </td>
                        </tr>
						 
						<tr>
                            <td><label>Upload Logo</label></td>
                            <td><input type="file" name="logo" /></td>
                        </tr>

						 <tr>
                            <td>
                            </td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>

                    </div>
                    <div class="right_sight">
                        <img src="<?php echo $result['logo']?>" alt="Logo Image">
                    </div>
                </div>
<?php } } ?>               
            </div>
        </div>
         <?php include_once 'inc/footer.php';?> 