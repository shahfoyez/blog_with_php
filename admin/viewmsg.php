<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php
    if(!isset($_GET['msgid']) || $_GET['msgid']==NULL){
        echo "<script>window.location= 'inbox.php';</script>";
        //header('Location: inbox.php');
    }else{
        $id=$_GET['msgid'];
    }
?>
    <div class="grid_10">
	
        <div class="box round first grid">
            <h2>View Message</h2>
           <?php
                if($_SERVER['REQUEST_METHOD']=='POST'){
                     echo "<script>window.location= 'inbox.php';</script>";
                }
            ?>
            <div class="block">               
             <form action="" method="post">
                <?php
                        $query="select * from tbl_contact where id='$id'";
                        $inbox=$db->select($query);
                        if($inbox){
                           while($result=$inbox->fetch_assoc()){

                     ?>
                <table class="form">
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input readonly type="text" value="<?php echo $result['firstname']." ".$result['lastname']?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                            <input readonly type="text" value="<?php echo $result['email'];?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Date</label>
                        </td>
                        <td>
                            <input readonly type="text" value="<?php echo $fm->formatDate($result['date']);?>" class="medium"/>
                        </td>
                    </tr>
                 
                    
                    <tr>
                        <td>
                            <label>Message</label>
                        </td>
                        <td>
                            <textarea class="tinymce"><?php echo $result['body'];?></textarea>
                        </td>
                    </tr>
					<tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="OK" />
                        </td>
                    </tr>
                </table>
            <?php } } else echo  "Invalid User Message";?>

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