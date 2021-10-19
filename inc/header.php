<?php
 	include 'config/config.php';
 	include 'lib/Database.php';
 	include 'helpers/Format.php';
 ?>
 <?php
 	$db=new Database();
 	$fm=new Format();
 ?>
<!DOCTYPE html>
<html>
<head>
	<?php include 'scripts/meta.php'; ?>
	<?php include 'scripts/css.php'; ?>
	<?php include 'scripts/js.php'; ?>

	
</head>
<body>
<div class="headersection templete clear">
	<?php
	$query="SELECT * from title_slogan where id='1'";
	$getdata=$db->select($query);
	if($getdata){
		while($result=$getdata->fetch_assoc()){
?>
		<a href="index.php">
			<div class="logo">
				<img src="admin/<?php echo $result['logo']; ?>"/>
				<h2><?php echo $result['title']; ?></h2>
				<p><?php echo $result['slogan']; ?></p>
			</div>
		</a>
	<?php  }} ?>
		<div class="social clear">
			<div class="icon clear">
			<?php
			    $query="SELECT * from tbl_social";
			    $socialdata=$db->select($query);
			    if($socialdata){
			        while($result=$socialdata->fetch_assoc()){    
			?>  
				<a href="<?php echo $result['fb'];?>"" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="<?php echo $result['tw'];?>"" target="_blank"><i class="fa fa-twitter"></i></a>
				<a href="<?php echo $result['li'];?>"" target="_blank"><i class="fa fa-linkedin"></i></a>
				<a href="<?php echo $result['gp'];?>"" target="_blank"><i class="fa fa-google-plus"></i></a>
			<?php }}?>
			</div>
			<div class="searchbtn clear">
			<form action="search.php" method="get">
				<input type="text" name="search" placeholder="Search keyword..."/>
				<input type="submit" name="submit" value="Search"/>
			</form>
			</div>
		</div>
	</div>
<div class="navsection templete">
	<ul>
		<li><a 
			<?php 
				 $path=$_SERVER['SCRIPT_FILENAME'];//fulll path name
				$page=basename($path, '.php');
				if($page=='index'){
					echo 'id=active';
				}
			?>

			href="index.php">Home</a></li>
		<?php
		    $query="SELECT * from tbl_page";
		    $page=$db->select($query);
		    if($page){
		        while($result=$page->fetch_assoc()){    
		?> 
		 
		<li><a href="page.php?pageid=<?php echo $result['id'];?>" 
			<?php
				if(isset($_GET['pageid']) && $_GET['pageid']==$result['id']){
					echo 'id=active';
				}
			?>><?php echo $result['name'];?></a></li>
		 
		<?php }} ?>
		<li><a 
			<?php 	
			 	$path=$_SERVER['SCRIPT_FILENAME'];//fulll path name
				$page=basename($path, '.php');
				if($page=='contact'){
					echo 'id=active';
				}
			?>
			href="contact.php">Contact</a></li>
	</ul>
</div>