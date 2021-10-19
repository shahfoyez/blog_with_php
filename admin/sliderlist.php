<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>No.</th>
					<th>Title</th>
					<th>Image</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$username=Session::get('username');
				$query="select * from tbl_slider";
				$slider=$db->select($query);
				if($slider){
					$i=0;
					while($result=$slider->fetch_assoc()){
						$i++;
			?>
				<tr class="gradeU">
					<td><?php echo $i.".";?></td>
					<td><?php echo $result['title'];?></td>
					<td><img src="<?php echo $result['img'];?>"  style="padding-top:5px; height: 70px; width:120px;"/></td>
					<td>
						<?php 
						if($username=='admin'){?>
							<a href="editslider.php?sliderid=<?php echo $result['id'];?>">Edit</a> ||
							<a onclick="return confirm('Are You Sure')" href="deleteslider.php?sliderdelid=<?php echo $result['id'];?>">Delete</a>
						<?php }else{
							echo "Resticted";
						}?>
							 
						 
					     
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