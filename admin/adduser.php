 
 <?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
 ?> 
 <?php
   if(Session::get('userrole')!='1'){ 
          echo "<script>window.location= 'index.php';</script>";   
    }
 ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New User</h2>
               <div class="block copyblock"> 
                <?php
                    if($_SERVER['REQUEST_METHOD']=='POST'){
                        $username=$fm->validation($_POST['username']);
                        $password=$fm->validation($_POST['password']);
                        $email=$fm->validation($_POST['email']);
                        $role=$fm->validation($_POST['role']);
                         

                        $username=mysqli_real_escape_string($db->link, $username);
                        $password=mysqli_real_escape_string($db->link, $password);
                        $email=mysqli_real_escape_string($db->link, $email);
                        $role=mysqli_real_escape_string($db->link, $role);
                        


                        if(empty($username)){
                            $erroru="Username Required";
                        }if(empty($password)){
                            $errorp="Password Requird";
                        }if(empty($role) || $role=="NULL"){
                            $errorr="User's Role Required";
                        }if(empty($email)){
                            $errore="Email Required";
                        } 
                        else{
                            $query="select * from tbl_user where email='$email'";
                            $result=$db->select($query);
                            if($result){
                                $errore="Email Address Already Exists";
                            }
                            else{
                                $password=md5($password);
                                $query="INSERT INTO tbl_user(username, pass, email, role)
                                        VALUES('$username','$password','$email','$role')";
                                $user=$db->insert($query);
                                if($user){
                                    echo "<span class='success'>User Added Successfully</span>";
                                }else{
                                    echo "<span class='error'>User Not Added</span>";
                                }
                            }
                        }
                        
                    }
                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Username:</label>
                            </td>
                            <td>
                                <?php
                                    if(isset($erroru)){
                                        echo "<span class='error'>$erroru</span></br>";
                                    }
                                ?>
                                <input type="text" name='username' placeholder="Enter Username Name..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Password:</label>
                            </td>
                            <td>
                                <?php
                                    if(isset($errorp)){
                                        echo "<span class='error'>$errorp</span></br>";
                                    }
                                ?>
                                <input type="text" name='password' placeholder="Enter Password..." class="medium" />
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label>Email:</label>
                            </td>
                            <td>
                            <?php
                                if(isset($errore)){
                                    echo "<span class='error'>$errore</span></br>";
                                }
                            ?>
                                <input type="text" name='email' placeholder="Enter Email Address..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>User's Role:</label>
                            </td>
                            <td>
                            <?php
                                if(isset($errorr)){
                                    echo "<span class='error'>$errorr</span></br>";
                                }
                            ?>
                                 <select id='select' name="role">
                                     <option value="NULL">Select User's Role</option>
                                     <option value="1">Admin</option>
                                     <option value="2">Author</option>
                                     <option value="3">Editor</option>
                                 </select>
                            </td>
                        </tr>
						<tr>
                            <td></td> 
                            <td>
                                <input type="submit" name="submit" Value="Create" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
    <?php include 'inc/footer.php'; ?>  

