 <?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
 ?> 
 <?php
    if(!isset($_GET['catid']) || $_GET['catid']==NULL){
        echo "<script>window.location= 'catlist.php';</script>";
        //header(Location: catlist.php);
    }else{
        $id=$_GET['catid'];
    }
 ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock"> 
                <?php
                    if($_SERVER['REQUEST_METHOD']=='POST'){
                        $name=$_POST['name'];
                        $name=mysqli_real_escape_string($db->link, $name);
                        if(empty($name)){
                            echo "<span class='error'>Field must not be empty!</span>";
                        }else{
                            $query="UPDATE tbl_catagory 
                                    SET
                                    name='$name' 
                                    where id='$id'";
                            $update=$db->update($query);
                            if($update){
                                echo "<span class='success'>Catagory Updated Successfully</span>";
                            }else{
                                echo "<span class='error'>Catagory Not Updated</span>";
                            }
                        }
                    }
                ?>
                <?php
                    $query="select * from tbl_catagory where id=$id order by id desc";
                    $cat=$db->select($query);
                    if($cat){
                    while($result=$cat->fetch_assoc()){

                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="name" Value="<?php echo $result['name'];?>" class="medium"/>
                            </td>
                        </tr>
						<tr> 
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
    <?php include 'inc/footer.php'; ?>  

