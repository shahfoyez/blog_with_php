  <?php

    include 'inc/header.php';
    include 'inc/sidebar.php';
 ?>
 <?php
    $userid=Session::get('userid');
    $role=Session::get('userrole');
 ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Profile</h2>
                <?php
                     if($_SERVER['REQUEST_METHOD']=='POST'){
                        $name   =mysqli_real_escape_string($db->link, $_POST['name']);
                        $username=mysqli_real_escape_string($db->link, $_POST['username']);
                        $email    =mysqli_real_escape_string($db->link, $_POST['email']);
                        $details    =mysqli_real_escape_string($db->link, $_POST['details']);
                        if(empty( $name) && empty( $username) && empty( $email) && empty( $details)){
                            echo "<span class='error'>All Fields Are empty!</span>";
                        }elseif(empty( $username)){
                            echo "<span class='error'>Username Can't be empty!</span>";
                        }else{
                            $query="UPDATE tbl_user 
                                     SET
                                     name='$name',
                                     username='$username',
                                     email='$email',
                                     details='$details'
                                     WHERE id='$userid'";
                            $updateuser=$db->update($query);
                            if($updateuser){
                                echo "<span class='success'>User's Data Updated Successfully</span>";
                            }else{
                                   echo "<span class='error'>User's Data can not be Updated</span>";
                            }
                        }
                    }
                ?>
                <div class="block"> 
                <?php
                    $quary="SELECT * from tbl_user where id='$userid' AND role='$role'";
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
                                <input type="text" name="name" value="<?php echo $result['name'];?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>User Name:</label>
                            </td>
                            <td>
                                <input type="text" name="username" value="<?php echo $result['username'];?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Email: </label>
                            </td>
                            <td>
                                 <input type="text" name="email" value="<?php echo $result['email'];?>" class="medium" />
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
                         <!--<tr>
                            <td>
                                <label>Role:</label>
                            </td>
                            <td>
                                <select readonly id='select' name="role">
                                     <option value="NULL">Select User's Role</option>
                                     <option value="1">Admin</option>
                                     <option value="2">Author</option>
                                     <option value="3">Editor</option>
                                 </select>
                            </td>
                        </tr>-->
                          
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