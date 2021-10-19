 <?php
 	include 'inc/header.php';
 ?>
 <?php
	if(!isset($_GET['pageid']) || $_GET['pageid']==NULL){
		 header("location: 404.php");

	}else{
		$id=$_GET['pageid'];
	}
?>
	<div class="contentsection contemplete clear">
		 
		<div class="maincontent clear">
			<div class="about">
				<?php
					$query="select * from tbl_page where id='$id'";
					$page= $db->select($query);
					if($page){
						while($result=$page->fetch_assoc()){
				?>
				<h2><?php echo $result['name'];?></h2>
				<?php echo $result['body'];?>
				<?php }} else{
					 header("location: 404.php");
				}?>
	</div>

</div>
		 
    <?php 
		include 'inc/sidebar.php';
		include 'inc/footer.php';
	?>