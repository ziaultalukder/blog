<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sideber.php';?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Copyright Text</h2>
                <div class="block copyblock"> 

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){


    $note = $_POST['note'];
    $note = $formate->validation($_POST['note']);
    $note   = mysqli_real_escape_string($db->link, $note);


    if($note == ""){
        echo '<span style="color:red; font-size:18px;">Field Must Not Be Empty.</span>';   
    }
    else{
        $query = "UPDATE footer 
                SET
                note = '$note'           
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
$query = "select * from footer where id='1'";
$socail = $db->select($query);
if($socail){
    while($result = $socail->fetch_assoc()){
?> 


                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="note" value="<?php echo $result['note']?>" class="large" />
                            </td>
                        </tr>
						
						 <tr> 
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