  <?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
 ?>
        <div class="grid_10">

		
            <div class="box round first grid">
                <h2>Add New Page</h2>
                <?php
                     if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['create'])){
                ?>
                         <h2><?php echo "create";?></h2>
                <?php }elseif($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['delete'])){
                ?>
                         <h2><?php echo "Delete";?></h2>
                <?php }?>
                    
                   
                <div class="block">               
                 <form action="" method="post">
                    <table class="form">
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" placeholder="Enter Post Title..." class="medium" />
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
                            <td></td>
                            <td>
                                <input type="submit" name="create" Value="Create" />
                                <input type="submit" name="delete" Value="Delete" />

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