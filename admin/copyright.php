 <?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
 ?>
 <div class="grid_10">
    <div class="box round first grid">
        <h2>Update Copyright Text</h2>
<?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $text=$fm->validation($_POST['copyright']);
        $text   =mysqli_real_escape_string($db->link, $text);
        if($text==""){
             echo "<span class='error'>Fields Can't be empty</span>";
        }else{
            $query="UPDATE tbl_footer 
                    SET
                    text='$text'
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
        <div class="block copyblock"> 
        <?php
            $query="SELECT * from tbl_footer";
            $footerdata=$db->select($query);
            if($footerdata){
            while($result=$footerdata->fetch_assoc()){    
        ?>  
         <form action="" method="post">
            <table class="form" action="" method="post">					
                <tr>
                    <td>
                        <input type="text" value="<?php echo $result['text'];?>" name="copyright" class="large" />
                    </td>
                </tr>
				
				 <tr> 
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
        <?php }} ?>
        </div>
    </div>
</div>
<div class="clear">
</div>
</div>
<?php include 'inc/footer.php';?> 