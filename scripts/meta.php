<?php 
		if(isset($_GET['pageid'])){//Page Title
			$titleid=$_GET['pageid'];
			$query="SELECT * from tbl_page where id='$titleid'";
			$pagetitle=$db->select($query);
			if($pagetitle){
				while($result=$pagetitle->fetch_assoc()){
	?>
	<title><?php echo $result['name'];?>-<?php echo TITLE;?></title>
	<?php } } } elseif(isset($_GET['id'])){//Post Title
			$postid=$_GET['id'];
			$query="SELECT * from tbl_post where id='$postid'";
			$posttitle=$db->select($query);
			if($posttitle){
				while($result=$posttitle->fetch_assoc()){
	?>
	<title><?php echo $result['title'];?>-<?php echo TITLE;?></title>
	<?php } } } elseif(isset($_GET['catagory'])){//Catagory Title
			$cattid=$_GET['catagory'];
			$query="SELECT * from tbl_catagory where id='$cattid'";
			$cattitle=$db->select($query);
			if($cattitle){
				while($result=$cattitle->fetch_assoc()){
	?>
	<title><?php echo $result['name']." Catagory";?>-<?php echo TITLE;?></title>
	<?php } } } else{?><!--Non Database Title-->
		<title><?php echo $fm->title();?> - <?php echo TITLE;?></title>
	<?php } ?>
	 
	<meta name="language" content="English">
	<meta name="description" content="It is a website about education">
	<?php
		if(isset($_GET['id'])){
			$key=$_GET['id'];
			$query="SELECT * from tbl_post where id='$key';";
		    $data=$db->select($query);
		    if($data){
		        while($result=$data->fetch_assoc()){?>  
	<meta name="keywords" content="<?php echo $result['tags'];?>">
	<?php } } }else{ ?>
		<meta name="keywords" content=<?php echo KEYWORD;?> >
	<?php  }?>
	<meta name="author" content="Delowar">