  <?php

    include 'inc/header.php';
    include 'inc/sidebar.php';
 ?>
 <?php
    if(!isset($_GET['viewid']) || $_GET['viewid']==NULL){
        echo "<script>window.location= 'postlist.php';</script>";
        //header(Location: catlist.php);
    }else{
        $id=$_GET['viewid'];
    }
 ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>User's Details</h2>
                <?php
                    if($_SERVER['REQUEST_METHOD']=='POST'){
                         echo "<script>window.location= 'userlist.php';</script>";
                    }
                ?>
                <div class="block"> 
                <?php
                    $quary="SELECT * from tbl_user where id='$id'";
                    $user=$db->select($quary);
                    if($user){
                        while($result=$user->fetch_assoc()){ 
                ?>
                               
                 <form action="" method="post">
                    <table class="form">

                        <tr>
                            <td>
                                <label>Name:</label>
                            </td>
                            <td>
                                <input readonly type="text"   value="<?php echo $result['name'];?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>User Name:</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['username'];?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Email: </label>
                            </td>
                            <td>
                                 <input type="text" readonly value="<?php echo $result['email'];?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Details:</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="details"><?php echo $result['details'];?></textarea>
                            </td>
                        </tr>
                          
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Ok"/>
                            </td>
                        </tr>
                    </table>
         
                    </form>
                <?php } } ?>
                </div>
            </div>
        </div>
         
    <!-- Load TinyMCE -->
    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>
<?php include 'inc/footer.php'; ?>  