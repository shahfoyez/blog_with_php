
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
    if(!isset($_GET['sliderdelid']) || $_GET['sliderdelid']==NULL){
        echo "<script>window.location= 'postlist.php';</script>";
        //header(Location: catlist.php);
    }else{
        $id=$_GET['sliderdelid'];
        $getquery="select * from tbl_post where id='$id'";
        $getslider=$db->select($getquery);
        if($getslider){
            while($delimg=$getslider->fetch_assoc()){
            	$dellink=$delimg['img'];
            	unlink($dellink);

            }
        } 
        $query="DELETE from tbl_slider where id='$id'";
        $delslider=$db->delete($query);
        if($delslider){
        	echo "<script>alert('Slider Deleted Successfully');</script>";
        	header("Location: sliderlist.php");
        }else{
        	echo "<script>alert('Slider Not Deleted');</script>";
        }   
	}
 ?>
 
  