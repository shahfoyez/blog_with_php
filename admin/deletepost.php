
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
    if(!isset($_GET['delpostid']) || $_GET['delpostid']==NULL){
        echo "<script>window.location= 'postlist.php';</script>";
        //header(Location: catlist.php);
    }else{
        $id=$_GET['delpostid'];
        $getquery="select * from tbl_post where id='$id'";
        $getdata=$db->select($getquery);
        if($getdata){
            while($delimg=$getdata->fetch_assoc()){
            	$dellink=$delimg['img'];
            	unlink($dellink);

            }
        } 
        $query="DELETE from tbl_post where id='$id'";
        $delpost=$db->delete($query);
        if($delpost){
        	echo "<script>alert('Data Deleted Successfully');</script>";
        	header("Location: postlist.php");
        }else{
        	echo "<script>alert('Data Not Deleted');</script>";
        }   
	}
 ?>
 
  