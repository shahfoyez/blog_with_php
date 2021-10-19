<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="style.css">
 <?php
    $query="select * from tbl_themes where id='1'";
    $theme=$db->select($query);
    while($result=$theme->fetch_assoc()){
    	if($result['theme']=="Default"){ ?>
    		<link rel="stylesheet" href="themes/default.css">
  		<?php }elseif($result['theme']=="Blue"){ ?>
    		<link rel="stylesheet" href="themes/blue.css"> ?>
  		 <?php }elseif($result['theme']=="Red"){ ?>
    		<link rel="stylesheet" href="themes/Red.css"> ?>
  		<?php } } ?>

 ?>