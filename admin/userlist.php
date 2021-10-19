 <?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
 ?>
 <?php
    $userid=Session::get('userid');
    $role=Session::get('userrole');
 ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>User List</h2>
        <?php
        	if(isset($_GET['deluser'])){
        		$deluser=$_GET['deluser'];
        		$delquery="DELETE FROM tbl_user where id='$deluser'";
        		$result=$db->delete($delquery);
        		if($result){
                   echo "<span class='success'>User Deleted Successfully</span>";
                   $result=1;
                }else{
                      echo "<span class='error'>User Not Deleted</span>";
                }
               
        	}
        ?>
        <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th width=8%>Serial No.</th>
					<th width=11%>Name</th>
					<th width=11%>User Name</th>
					<th width=15%>Email</th>
					<th width=27%>Details</th>
					<th width=10%>Role</th>
					<th width=18%>Action</th>


				</tr>
			</thead>
			<tbody>
				<?php
					$query="SELECT * FROM tbl_user order by id desc";
					$users=$db->select($query);
					if($users){
						$i=0;
						while($result= $users->fetch_assoc()){
							$i++;
				?>
				<tr class="even gradeC">
					<td><?php echo $i;?></td>
					<td><?php echo $result['name'];?></td>
					<td><?php echo $result['username'];?></td>
					<td><?php echo $result['email'];?></td>
					<td><?php echo $fm->readMore($result['details'], 20);?></td>
					<td>
						<?php 
							$role=$result['role'];
							if($role==1){
								echo "Admin";
							}elseif($role==2){
								echo "Author";
							}
							elseif($role==3){
								echo "Editor";
							}
						?>
					</td>
					<td>
						 
							<a href="viewuser.php?viewid=<?php echo $result['id'];?>">View </a>
			<?php
			 	$role=Session::get('userrole');
                if($role=='1'){
            ?>
							<a onclick="return confirm('Are You Sure')" href="?deluser=<?php echo $result['id'];?>">|| Delete</a>
			<?php } ?>
						 
					 
					</td>
					<!--<td>
						<?php 
								if($userid==$result['id'] || $userid=='9'){
						?>
						<a 
							href="viewuser.php?id=<?php echo $result['id'];?>">View ||
						</a>
						<a href="editcat.php?userid=<?php echo $result['id'];?>">Edit</a> ||
						<a 
							onclick="return confirm('Are You Sure')" 
							href="?delid=<?php echo $result['id'];?>">Delete
						</a>
					<?php }else{ ?>
						<a 
							href="viewuser.php">View
						</a>
					<?php } ?>
					</td>-->
				</tr>
				 
			<?php }} ?>
			</tbody>
		</table>
       </div>
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
         