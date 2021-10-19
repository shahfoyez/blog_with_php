 <?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
 ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Social Media</h2>
<?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $fb=$fm->validation($_POST['facebook']);
        $tw=$fm->validation($_POST['twitter']);
        $li=$fm->validation($_POST['linkedin']);
        $gp=$fm->validation($_POST['google']);
        $fb   =mysqli_real_escape_string($db->link, $fb);
        $tw   =mysqli_real_escape_string($db->link, $tw);
        $li  =mysqli_real_escape_string($db->link, $li);
        $gp   =mysqli_real_escape_string($db->link, $gp);
        if($fb=="" || $tw==""|| $li=="" || $gp=="" ){
             echo "<span class='error'>Fields Can't be empty</span>";
        }else{
            $query="UPDATE tbl_social 
                    SET
                    fb='$fb',
                    tw='$tw',
                    li='$li',
                    gp='$gp'
                    WHERE id='1'";
            $updatepost=$db->update($query);
            if($updatepost){
                echo "<span class='success'>Data Updated Successfully</span>";
            }else{
                   echo "<span class='error'>Data can not be Updated</span>";
            }
        } 
    }
?>
                <div class="block">  
                 <?php
                    $query="SELECT * from tbl_social where id='1'";
                    $socialdata=$db->select($query);
                    if($socialdata){
                        while($result=$socialdata->fetch_assoc()){    
                ?>             
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Facebook</label>
                            </td>
                            <td>
                                <input type="text" name="facebook" value="<?php echo $result['fb'];?>" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Twitter</label>
                            </td>
                            <td>
                                <input type="text" name="twitter" value="<?php echo $result['tw'];?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>LinkedIn</label>
                            </td>
                            <td>
                                <input type="text" name="linkedin" value="<?php echo $result['li'];?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>Google Plus</label>
                            </td>
                            <td>
                                <input type="text" name="google" value="<?php echo $result['gp'];?>" class="medium" />
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
                <?php }}?>
                </div>
            </div>
        </div>
       <?php include 'inc/footer.php'; ?>  

