<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th width='4%'>No.</th>
					<th width='10%'>Post Title</th>
					<th width='22%'>Description</th>
					<th width='10%'>Category</th>
					<th width='10%'>Image</th>
					<th width='7%'>Author</th>
					<th width='7%'>Tags</th>
					<th width='15%'>Date</th>
					<th width='17%'>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$userid=Session::get('userid');
				$query="select tbl_post.*, tbl_catagory.name from tbl_post
				inner join tbl_catagory
				on tbl_post.cat=tbl_catagory.id
				order by tbl_post.userid desc";
				$posts=$db->select($query);
				if($posts){
					$i=0;
					while($result=$posts->fetch_assoc()){
						$i++;
			?>
				<tr class="gradeU">
					<td><?php echo $i.".";?></td>
					<td><?php echo $result['title'];?></td>
					<td> <?php echo $fm->readMore($result['body'], 70);?></td>
					<td><?php echo $result['name'];?></td>
					<td><img src="<?php echo $result['img'];?>"  style="padding-top:5px; height: 50px; width:70px;"/></td>
					<td><?php echo $result['author'];?></td>
					<td><?php echo $result['tags'];?></td>
					<td><?php echo $fm->formatDate($result['date']);?></td>
					<td>
						<a href="viewpost.php?viewpostid=<?php echo $result['id'];?>">View</a>
						<?php 
							$userid=Session::get('userid');
							if($result['userid']==$userid || Session::get('userrole')==1){
						?>
						|| <a href="editpost.php?editpostid=<?php echo $result['id'];?>">Edit</a> ||
						 
						<a onclick="return confirm('Are You Sure')" href="deletepost.php?delpostid=<?php echo $result['id'];?>">Delete</a>
					    <?php } ?>
					</td>
				</tr>
			<?php }}?>
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