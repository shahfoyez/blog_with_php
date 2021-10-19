  
 <?php
 	include 'inc/header.php';
 	include 'inc/slider.php';
 ?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<!--pagination-->
				<?php 
					$per_page=4;
					if(isset($_GET["page"])){
						$page=$_GET["page"];

					}else{
						$page=1;
					}
					$start_from=($page-1)*$per_page;
				?>
			<!--pagination-->
			<?php
				$query="select * from tbl_post limit $start_from, $per_page";
				$post=$db->select($query);
				if($post){
					while($post->fetch_assoc()){
						$result = $post->fetch_assoc();
						print_r($result);
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
			<?php }?><!--end While-->
			<!--pagination-->
			<?php 
			$query="select * from tbl_post";
			$result=$db->select($query);
			$total_rows=mysqli_num_rows($result);
			$total_pages=ceil($total_rows/$per_page);

			echo "<span class='pagination' style=''><a href='index.php?page=1'>".'First Page'."</a>";
			for ($i=1; $i <$total_pages-1 ; $i++) { 
				 echo  "<a href='index.php?page=".($i+1)."'>".($i)."</a>";
			}
			echo "<a href='index.php?page=$total_pages'>".'Last Page'."</a></span>";
			 ?>
			<!--pagination-->

		<?php } else{header("Location:404.php");}?>
		</div>
	<?php 
		include 'inc/sidebar.php';
		include 'inc/footer.php';
	?>
		 