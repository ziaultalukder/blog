<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sideber.php';?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Social Media</h2>
                <div class="block"> 

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){


    $fb = $_POST['fb'];
    $twter = $_POST['twter'];
    $ln = $_POST['ln'];
    $gd = $_POST['gd'];


    $fb = $formate->validation($_POST['fb']);
    $twter = $formate->validation($_POST['twter']);
    $ln = $formate->validation($_POST['ln']);
    $gd = $formate->validation($_POST['gd']);

    $fb   = mysqli_real_escape_string($db->link, $fb);
    $twter   = mysqli_real_escape_string($db->link, $twter);
    $ln   = mysqli_real_escape_string($db->link, $ln);
    $gd   = mysqli_real_escape_string($db->link, $gd);

    if($fb == "" || $twter == "" || $ln == "" || $gd == ""){
        echo '<span style="color:red; font-size:18px;">Field Must Not Be Empty.</span>';   
    }
    else{
        $query = "UPDATE social 
                SET
                fb = '$fb',
                twter = '$twter',
                ln = '$ln',
                gd = '$gd'           
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

?>





<?php
$query = "select * from social where id='1'";
$socail = $db->select($query);
if($socail){
    while($result = $socail->fetch_assoc()){
?>    
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Facebook</label>
                            </td>
                            <td>
                                <input type="text" name="fb" value="<?php echo $result['fb']; ?>" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Twitter</label>
                            </td>
                            <td>
                                <input type="text" name="twter" value="<?php echo $result['twter']; ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>LinkedIn</label>
                            </td>
                            <td>
                                <input type="text" name="ln" value="<?php echo $result['ln']; ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>Google Plus</label>
                            </td>
                            <td>
                                <input type="text" name="gd" value="<?php echo $result['gd']; ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php } } ?>
                </div>
            </div>
        </div>
         <?php include_once 'inc/footer.php';?>  