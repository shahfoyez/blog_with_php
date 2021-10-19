
<?php
 	include '../lib/Session.php';
 	Session::checkSession();
 	 
 ?><?php
 	include '../config/config.php';
 	include '../lib/Database.php';
 	include '../helpers/Format.php';
 ?>
 <?php
 	$db=new Database();
 ?>
 <?php
    if(!isset($_GET['delpage']) || $_GET['delpage']==NULL){
        echo "<script>window.location= 'page.php';</script>";
        //header(Location: catlist.php);
    }else{
        $id=$_GET['delpage'];
        $query="DELETE from tbl_page where id='$id'";
        $delpage=$db->delete($query);
        if($delpage){
        	echo "<script>alert('Page Deleted Successfully');</script>";
            header("Location: index.php");
        }else{
        	echo "<script>alert('Page Not Deleted');</script>";
        }   
	}
 ?>
 
  