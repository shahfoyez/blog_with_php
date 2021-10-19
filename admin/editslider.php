  <?php

    include 'inc/header.php';
    include 'inc/sidebar.php';
 ?>
 <?php
    if(!isset($_GET['sliderid']) || $_GET['sliderid']==NULL){
        echo "<script>window.location= 'sliderlist.php';</script>";
        //header(Location: catlist.php);
    }else{
        $id=$_GET['sliderid'];
    }
 ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Slider</h2>
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
                        $upload_image="upload/".$unique_name;
                        if(empty($title)){
                             
                                   echo "<span class='error'>Please Inter a title</span>";
                        }elseif(empty($file_name)){
                             $query="UPDATE tbl_slider
                                     SET
                                     title='$title'
                                     WHERE id='$id'";
                            $updateslider=$db->update($query);
                            if($updateslider){
                                echo "<span class='success'>Slider Updated Successfully</span>";
                            }else{
                                   echo "<span class='error'>Slider can not be Updated</span>";
                            }

                        }elseif($file_size>1048567){
                            echo "<span style='color:red'>File's size should be less than 1 MB</span>";
                        }
                        elseif(in_array($file_ext, $permitted)==false){
                            echo "<span style='color:red'>Upload ".implode(", ",$permitted)." Only</span>";
                        }else{
                            move_uploaded_file($file_tmp, $upload_image);
                            $query="UPDATE tbl_slider
                                     SET
                                     title='$title',
                                     img='$upload_image'
                                     WHERE id='$id'";
                            $updateslider=$db->update($query);
                            if($updateslider){
                                echo "<span class='success'>Slider Updated Successfully</span>";
                            }else{
                                   echo "<span class='error'>Slider can not be Updated</span>";
                            }
                        }
                    }
                ?>
                <div class="block"> 
                 <?php
                        $query="Select * from tbl_slider where id='$id'";
                        $getslider=$db->select($query);
                        if($getslider){
                            while($postresult=$getslider->fetch_assoc()){
                    ?>              
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                    
                        <tr>
                            <td>
                                <label>Slider Title:</label>
                            </td>
                            <td>
                                <input type="text" name="title" value="<?php echo $postresult['title'];?>" class="medium" />
                            </td>
                        </tr>
                     
                        
                        <tr>
                            <td>
                                <br/><label>Slider Image:</label>
                            </td>
                            <td>
                                <img src="<?php echo $postresult['img'];?>" height="75px" width="150px"/> <br/>
                                <input type="file" name="image"/>
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