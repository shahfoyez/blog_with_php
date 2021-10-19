  <?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
 ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Post</h2>
                <?php
                     if($_SERVER['REQUEST_METHOD']=='POST'){
                        $title   =mysqli_real_escape_string($db->link, $_POST['title']);
                        $category=mysqli_real_escape_string($db->link, $_POST['cat']);
                        $body    =mysqli_real_escape_string($db->link, $_POST['body']);
                        $tags    =mysqli_real_escape_string($db->link, $_POST['tags']);
                        $author  =mysqli_real_escape_string($db->link, $_POST['author']);
                        $userid  =mysqli_real_escape_string($db->link, $_POST['id']);



                       /* $username=Session::get('username');
                        $queryid="select * from tbl_user where username='$username'";
                        $user=$db->select($queryid);
                        if($user){
                            while($result=$user->fetch_assoc())
                            $userid=$result['id'];
                        }ID Insert */


                        $permitted=array('jpg','png','gif','jpeg');
                        $file_name=$_FILES['image']['name'];
                        $file_size=$_FILES['image']['size'];
                        $file_tmp=$_FILES['image']['tmp_name'];
                        $div=explode(".", $file_name);
                        $file_ext=strtolower(end($div));
                        $unique_name=substr(md5(time()), 0, 10).'.'.$file_ext;
                        $upload_image="upload/".$unique_name;
                        if($title=="" || $category==""|| $body=="" ||$tags=="" ||$author=="" ||$file_name==""){
                             echo "<span class='error'>Fields Can't be empty</span>";
                        }elseif($file_size>1048567){
                            echo "<span style='color:red'>File's size should be less than 1 MB</span>";
                        }
                        elseif(in_array($file_ext, $permitted)==false){
                            echo "<span style='color:red'>Upload ".implode(", ",$permitted)." Only</span>";
                        }else{
                            move_uploaded_file($file_tmp, $upload_image);
                            $query="insert into tbl_post(cat, title, body, img, author, tags, userid) values('$category','$title','$body','$upload_image','$author','$tags','$userid')";
                            $insert=$db->insert($query);
                            if($insert){
                                 echo "<span class='success'>Data Inserted Successfully</span>";
                            }else{
                                 echo "<span class='error'>Data can not be Inserted</span>";
                            }
                        }

                    }
                ?>
                <div class="block">               
                 <form action="addpost.php" method="post" enctype="multipart/form-data">
                    <table class="form">
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" placeholder="Enter Post Title..." class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="cat">
                                    <option value="<?php echo "";?>">Select Category</option>
                                    <?php
                                        $query="SELECT * FROM tbl_catagory";
                                        $cat=$db->select($query);
                                        if($cat){
                                            while($result=$cat->fetch_assoc()){
                                    ?>
                                    <option value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>
                                    <?php }} ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input type="file" name="image"/>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"></textarea>
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tags" placeholder="Enter Tags Here" class="medium" />
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" name="author" value="<?php echo Session::get('username');?>"class="medium" />
                                <input type="hidden" name="id" value="<?php echo Session::get('userid');?>"class="medium" />

                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
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