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
            <h2>Replt Text</h2>
           <?php
                if($_SERVER['REQUEST_METHOD']=='POST'){
                    $tomail   =$fm->validation($_POST['tomail']);
                    $frommail =$fm->validation($_POST['frommail']);
                    $sub =$fm->validation($_POST['subjet']);
                    $message  =$fm->validation($_POST['body']);

                    $tomail=mysqli_real_escape_string($db->link, $message);
                    $sub=mysqli_real_escape_string($db->link, $sub);
                    if(empty($frommail)){
                        $msgf="*";
                    }if(empty($message)){
                        $msgm="*";
                    }else{
                        $sendmail=mail($tomail,$sub,$message,$frommail);
                        if($sendmail){
                            echo "<span class='success'>Email send Successfully</span>";
                        }else{
                             echo "<span class='error'>Email is not send</span>";
                        }
                    }

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
                            <label>To</label>
                        </td>
                        <td>
                            <input readonly name="tomail" type="text" value="<?php echo $result['email'];?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>From</label>
                        </td>
                        <td>
                            <?php
                                if(isset($msgf)){
                                    echo "<span style='color: red'>Enter Email</span></br>";
                                }
                            ?>
                            <input name="frommail" type="text" placeholder="Enter Your Email Address" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Subject</label>
                        </td>
                        <td>
                            <input name="subjet" type="text" placeholder="Enter Your email Subject" />
                        </td>
                    </tr>
                 
                    
                    <tr>
                        <td>
                             
                            <label>Message</label>
                            
                        </td>
                        <td>
                            <?php
                                if(isset($msgm)){
                                    echo "<span style='color: red'>Enter Message</span>";
                                }
                            ?>
                            <textarea class="tinymce" name="body"></textarea>
                        </td>
                    </tr>
					<tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Send" />
                        </td>
                    </tr>
                </table>
            <?php } }else echo  "Invalid User Message"; ?>

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