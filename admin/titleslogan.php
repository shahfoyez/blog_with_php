<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
 ?>
 <style>
     .leftside{
        float: left;
        width: 70%;
     }
     .rightside{
        float: right;
        width: 20%;
     }
     .rightside img{
        height: 80px;
        width: 160px;
     }
 </style>
  <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Site Title and Description</h2>
<?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $title=$fm->validation($_POST['title']);
        $slogan=$fm->validation($_POST['sloga']);
        $title   =mysqli_real_escape_string($db->link, $title);
        $slogan=mysqli_real_escape_string($db->link, $slogan);

        $permitted=array('png');
        $file_name=$_FILES['logo']['name'];
        $file_size=$_FILES['logo']['size'];
        $file_tmp=$_FILES['logo']['tmp_name'];

        $div=explode(".", $file_name);
        $file_ext=strtolower(end($div));
        $same_name= 'logo'.'.'.$file_ext;
        $upload_logo="upload/".$same_name;
        if($title=="" || $slogan==""){
             echo "<span class='error'>Fields Can't be empty</span>";
        }else{
            if(!empty($file_name)){
                if($file_size>1048567){
                    echo "<span style='color:red'>File's size should be less than 1 MB</span>";
                }
                elseif(in_array($file_ext, $permitted)==false){
                    echo "<span style='color:red'>Upload ".implode(", ",$permitted)." Only</span>";
                }else{
                    move_uploaded_file($file_tmp, $upload_logo);
                    $query="UPDATE title_slogan 
                             SET
                             title='$title',
                             slogan='$slogan',
                             logo='$upload_logo'
                             WHERE id='1'";
                    $updatepost=$db->update($query);
                    if($updatepost){
                        echo "<span class='success'>Data Updated Successfully</span>";
                    }else{
                           echo "<span class='error'>Data can not be Updated</span>";
                    }
                }
            }elseif(empty($file_name)){
                  $query="UPDATE title_slogan 
                             SET
                             title='$title',
                             slogan='$slogan'
                             WHERE id='1'";
                    $updatepost=$db->update($query);
                    if($updatepost){
                        echo "<span class='success'>Data Updated Successfully</span>";
                    }else{
                           echo "<span class='error'>Data can not be Updated</span>";
                    }
            }
        } 
    }
?>
                <?php
                    $query="SELECT * from title_slogan WHERE id='1'";
                    $getdata=$db->select($query);
                    if($getdata){
                        while($result=$getdata->fetch_assoc()){
                ?>
                <div class="block sloginblock">  
                <div class="leftside">   
                         
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Website Title</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['title'];?>"  name="title" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Website Slogan</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['slogan'];?>" name="sloga" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Website Logo</label>
                            </td>
                            <td>
                                <input type="file" name="logo" class="medium" />
                            </td>
                        </tr>
						 
						
						 <tr>
                            <td>
                            </td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
                <div class="rightside">
                    <img src="<?php echo $result['logo'];?>" alt="logo"/>
                </div>
                </div>
            <?php } } ?>
            </div>
        </div>
        <?php include 'inc/footer.php'; ?>  

