<?php
 	include 'inc/header.php';
 	include 'inc/slider.php';
 ?>
 <?php
 	$catagory=mysqli_real_escape_string($db->link, $fname);
 	if(!isset($catagory) || $catagory==NULL){
 		header("Location: 404.php");
 	}else{
 		$catid=$catagory;
 	}
 ?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<?php
				$query="select * from tbl_post where cat='$catid'";
				$post=$db->select($query);
				if($post){
					while($result = $post->fetch_assoc()){
			?>
			<div class="samepost clear">
				<h2><a href="post.php?id=<?php echo $result['id'];?>"><?php echo $result['title'];?> </a></h2>
				<h4> <?php echo $fm->formatDate($result['date']);?><a href="#"><?php echo " ".$result['author'];?></a></h4>
				 <img src="admin/<?php  echo $result['img'];?>" alt="post image"/>
				<?php echo $fm->readMore($result['body'], );?>
				<div class="readmore clear">
					<a href="post.php?id=<?php echo $result['id'];?>">Read More</a>
				</div>
			</div>
				<?php } }else{?>
					<h3>No Posts Available</h3>
				<?php }?>
	</div>
	<?php 
		include 'inc/sidebar.php';
		include 'inc/footer.php';
	?>