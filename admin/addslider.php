  <?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
 ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Slider</h2>
                <?php
                        if($_SERVER['REQUEST_METHOD']=='POST'){
                        $title   =mysqli_real_escape_string($db->link, $_POST['title']);

                        $permitted=array('jpg','png','gif','jpeg');
                        $file_name=$_FILES['image']['name'];
                        $file_size=$_FILES['image']['size'];
                        $file_tmp=$_FILES['image']['tmp_name'];
                        $div=explode(".", $file_name);
                        $file_ext=strtolower(end($div));
                        $unique_name=substr(md5(time()), 0, 10).'.'.$file_ext;
                        $upload_image="upload/slider/".$unique_name;
                        if($title=="" || $file_name==""){
                             echo "<span class='error'>Fields Can't be empty</span>";
                        }elseif($file_size>1048567){
                            echo "<span style='color:red'>File's size should be less than 1 MB</span>";
                        }
                        elseif(in_array($file_ext, $permitted)==false){
                            echo "<span style='color:red'>Upload ".implode(", ",$permitted)." Only</span>";
                        }else{
                            move_uploaded_file($file_tmp, $upload_image);
                            $query="insert into tbl_slider(title,img) values('$title','$upload_image')";
                            $insert=$db->insert($query);
                            if($insert){
                                 echo "<span class='success'>Slider Inserted Successfully</span>";
                            }else{
                                 echo "<span class='error'>Slider can not be Inserted</span>";
                            }
                        }

                    }
                ?>
                <div class="block">               
                 <form action="addslider.php" method="post" enctype="multipart/form-data">
                    <table class="form">
                        <tr>
                            <td>
                                <label>Slider Image</label>
                            </td>
                            <td>
                                <input type="file" name="image"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" placeholder="Enter Slider Title..." class="medium" />
                            </td>
                        </tr>
                     
                        
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Add Slider" />
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