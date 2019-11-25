<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php'; ?>
<?php 
   $brand = new Brand();
   if (isset($_GET['deleteBrand'])) {
   	  $id=$_GET['deleteBrand'];
   	  $id=preg_replace('/[^-a-zA-z0-9_]/', '', $_GET['deleteBrand']);
   	  $deleteBrandId=$brand->deleteBrandById($id);
   }
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Brand List</h2>
                <div class="block">  
	        <?php 
	         if (isset($deleteBrandId)) {
	         	echo $deleteBrandId;
	           }
	         ?>      
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Brand Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
				<?php 
                 $getbrand = $brand->getAllbrand();
                 if ($getbrand) {
                 	$x=0;
                 	while ($result=$getbrand->fetch_assoc()) {
                 		$x++;
				 ?>
						<tr class="odd gradeX">
							<td><?php echo $x; ?></td>
							<td><?php echo $result['brandName']; ?></td>
							<td><a href="brandedit.php?brandid=<?php echo $result['brandId']; ?>">Edit</a> || <a onclick="return confirm('Do You want to Delete This')" href="?deleteBrand=<?php echo $result['brandId']; ?>">Delete</a></td>
						</tr>
				<?php } }else{ echo "<span class='error'>The Brand Name Not Fund</span>"; } ?>
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
<?php include 'inc/footer.php';?>

