<div class="sidebar clear">
			<div class="samesidebar clear">
				<h2>Categories</h2>
					<ul>
					<?php
						$query="select * from tbl_catagory";
						$cat=$db->select($query);
						if($cat){
							while($result=$cat->fetch_assoc()){
					?>
						<li><a href="postes.php?catagory=<?php echo $result['id'];?>"> <?php echo $result['name']?></a></li>
					<?php }} else{?>
					 
						<li>No Catagory Available</li>
					<?php }?>
						 					
					</ul>
			</div>
			
			<div class="samesidebar clear">
				<h2>Latest articles</h2>
					<?php
						$query="select * from tbl_post limit 5";
						$cat=$db->select($query);
						if($cat){
							while($result=$cat->fetch_assoc()){
					?>
					<div class="popular clear">
						<h3><a href="post.php?id=<?php echo $result['id'];?>"> <?php echo $result['title'];?></a></h3>
						<a href="post.php?id=<?php echo $result['id'];?>"><img src="admin/<?php echo $result['img'];?>" alt="post image"/></a>
						<?php echo $fm->readMore($result['body'], 120);?>
					</div>
						<?php } } else{header("Location:404.php");}?>
			</div>
			
		</div>