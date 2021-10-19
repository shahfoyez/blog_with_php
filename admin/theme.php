 <?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
 ?> 
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Themes</h2>
               <div class="block copyblock"> 
                <?php
                    if($_SERVER['REQUEST_METHOD']=='POST'){
                        $theme=$_POST['theme'];
                        $theme=mysqli_real_escape_string($db->link, $theme);
                        $query="UPDATE tbl_themes 
                                SET
                                theme='$theme' 
                                where id='1'";
                        $update=$db->update($query);
                        if($update){
                            echo "<span class='success'>Theme Updated Successfully</span>";
                        }else{
                            echo "<span class='error'>Theme Not Updated</span>";
                        }
                    }
                ?>
                <?php
                    $query="select * from tbl_themes where id='1'";
                    $theme=$db->select($query);
                    if($theme){
                    while($result=$theme->fetch_assoc()){

                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input <?php if($result['theme']=='Default'){ echo "checked";}?> 
                                type="radio" name="theme" Value="Default"/>Default
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input <?php if($result['theme']=='Blue'){ echo "checked";}?>  type="radio" name="theme" Value="Blue"/>Blue
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input <?php if($result['theme']=='Red'){ echo "checked";}?>  type="radio" name="theme" Value="Red"/>Red
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Apply Theme" />
                            </td>
                        </tr>
                    </table>
                </form>
                <?php }} ?>
                </div>
            </div>
        </div>
    <?php include 'inc/footer.php'; ?>  

