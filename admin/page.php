  <?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
 ?>

<?php
    if(!isset($_GET['pageid']) || $_GET['pageid']==NULL){
        echo "<script>window.location= 'index.php';</script>";
        //header(Location: catlist.php);
    }else{
        $id=$_GET['pageid'];
    }
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit Page</h2>
                <?php
                     if($_SERVER['REQUEST_METHOD']=='POST'){
                        $name=$_POST['name'];
                        $body=$_POST['body'];

                        $name=mysqli_real_escape_string($db->link, $name);
                        $body=mysqli_real_escape_string($db->link, $body);

                        if($name=="" ||  $body==""){
                            echo "<span class='error'>Field must not be empty!</span>";
                        }else{
                            $query="UPDATE tbl_page 
                                    SET
                                    name='$name',
                                    body='$body'
                                    where id='$id'";
                            $update=$db->update($query);
                            if($update){
                                echo "<span class='success'>Page Updated Successfully</span>";
                            }else{
                                echo "<span class='error'>Page Not Updated</span>";
                            }
                        }
                    }
                ?>
                <div class="block"> 
                <?php
                    $query="SELECT * from tbl_page Where id='$id'";
                    $pages=$db->select($query);
                    if($pages){
                    while($result=$pages->fetch_assoc()){    
                ?>               
                 <form action="" method="post">
                    <table class="form">
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name"  value="<?php echo $result['name'];?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"> <?php echo $result['body'];?> </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                                <span class="actiondel"><a onclick="return confirm('Are You Sure to Delete The Page')" href="delpage.php?delpage=<?php echo $result['id'];?>">Delete</a></span>

                            </td>
                        </tr>
                      </table>
                    </form>
                    <?php }}?>
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