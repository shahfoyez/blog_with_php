 
<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
 ?>

  
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <?php //UPDATE
				 	if(isset($_GET['seenid'])){
				 		$seenid=$_GET['seenid'];
				 		$quary="UPDATE tbl_contact 
				 				SET 
				 				status='1'
				 				WHERE id='$seenid'";
				 		$seenupdate=$db->UPDATE($quary);
				 		if($seenupdate==true){
				 			 echo "<span class='success'>Message send to the seen box</span>";
				 		}else{
				 			 echo "<span class='error'>Something Wrong</span>";
				 		}
				 		
				 	}
 				?>

                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width= 8%;>Serial No.</th>
							<th width= 14%;>Name</th>
							<th width= 14%;>Email</th>
							<th  width= 30%;>Message</th>
							<th  width= 18%;>Date</th>
							<th  width= 16%;>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php //SELECT 
		                    $query="select * from tbl_contact where status='0'";
		                    $inbox=$db->select($query);
		                    if($inbox){
		                    	$i=0;
		                 	   while($result=$inbox->fetch_assoc()){
		                 	   	$i++;
              		 	 ?>
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $result['firstname']." ".$result['lastname'];?></td>
							<td><?php echo $result['email'];?></td>
							<td><?php echo $fm->readMore($result['body'], 40);?></td>
							<td><?php echo $fm->formatDate($result['date']);?></td>
							<td>
								<a href="viewmsg.php?msgid=<?php echo $result['id'];?>">View</a> || 
								<a href="replymsg.php?msgid=<?php echo $result['id'];?>">Reply</a> ||
								<a onclick="return confirm('Are You Sure to Send it to send Box')"  href="?seenid=<?php echo $result['id'];?>">Seen</a>
							</td>
							</tr>
						 <?php }} ?>
					</tbody>
				</table>
               </div>
            </div>
             <div class="box round first grid">
                <h2>Seen Message</h2>
                <?php //DELETE
		        	if(isset($_GET['delid'])){
		        		$delid=$_GET['delid'];
		        		$delquery="DELETE FROM tbl_contact where id='$delid'";
		        		$result=$db->delete($delquery);
		        		if($result){
		                   echo "<span class='success'>Message Deleted Successfully</span>";
		                }else{
		                      echo "<span class='error'>Message Not Deleted</span>";
		                }
		        	}
		        ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width= 8%;>Serial No.</th>
							<th width= 17%;>Name</th>
							<th width= 17%;>Email</th>
							<th  width= 30%;>Message</th>
							<th  width= 16%;>Date</th>
							<th  width= 12%;>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
		                    $query="select * from tbl_contact where status='1'";
		                    $inbox=$db->select($query);
		                    if($inbox==true){
		                    	$i=0;
		                 	   while($result=$inbox->fetch_assoc()){
		                 	   	$i++;
              		 	?>
						<tr class="odd gradeX">
							<td><?php echo $i?></td>
							<td><?php echo $result['firstname']." ".$result['lastname'];?></td>
							<td><?php echo $result['email'];?></td>
							<td><?php echo $fm->readMore($result['body'], 40);?></td>
							<td><?php echo $fm->formatDate($result['date']);?></td>
							<td>
								<a href="viewmsg.php?msgid=<?php echo $result['id'];?>">View</a> || 
								<a onclick="return confirm('Are You Sure')" 
									href="?delid=<?php echo $result['id'];?>">Delete
								</a>
							</tr>
						<?php } } ?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <script type="text/javascript">
		$(document).ready(function () {
	 	   setupLeftMenu();
	 	   $('.datatable').dataTable();
	  	  setSidebarHeight();
		});
</script>
    <?php include 'inc/footer.php'; ?>  

