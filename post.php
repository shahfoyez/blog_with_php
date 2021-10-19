 <?php
 	include 'inc/header.php';
 ?>
 <?php
 	$postid=mysqli_real_escape_string($db->link, $_GET['id']);
 	if(!isset($postid) || $postid==NULL){
 		header("Location: 404.php");
 	}else{
 		$id=$postid;
 	}
 ?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<?php
					$query="select * from tbl_post where id=$id";
					$post=$db->select($query);
					if($post){
						while($result=$post->fetch_assoc()){

				?>
				<h2><?php echo $result['title'];?></h2>
				<h4> <?php echo $fm->formatDate($result['date']);?>
				<a href="#"><?php echo " ".$result['author'];?></a>
				<img src="admin/<?php echo $result['img'];?>" alt="post image"/>
				<?php echo $result['body'];?>
				<div id="disqus_thread"></div>
<script>
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://http-localhost-9-blog-with-adminpanel.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                            
				<div class="relatedpost clear">
					<h2>Related articles</h2>
					<?php

						$catid=$result['cat'];
						$catquery="select * from tbl_post where cat='$catid' And id!='$id' limit 6";
						$relatedpost=$db->select($catquery);
						if($relatedpost){
							while($rresult=$relatedpost->fetch_assoc()){
					?>
					<a href="post.php?id=<?php echo $rresult['id'];?>">
						<img src="admin/<?php echo $rresult['img'];?>" alt="post image"/>
					</a>
					 <?php }} else{ echo "There is No related Post";}?><!--if while close-->	
				</div>
				<?php }}else{header("Location: 404.php");}?><!-- if while close-->	
	</div>

</div>
    <?php 
		include 'inc/sidebar.php';
		include 'inc/footer.php';
	?>