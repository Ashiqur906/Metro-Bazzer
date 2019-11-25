<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Category.php'; ?>
<?php 
   $cat=new Category();
   if (isset($_GET['deleteCategory'])) {
   	  $id=$_GET['deleteCategory'];
   	  $id=preg_replace('/[^-a-zA-z0-9_]/', '', $_GET['deleteCategory']);
   	  $deleteId=$cat->deleteCatById($id);
   }
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">  
	        <?php 
	         if (isset($deleteId)) {
	         	echo $deleteId;
	           }
	         ?>      
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
				<?php 
                 $getCategory = $cat->getAllcategory();
                 if ($getCategory) {
                 	$x=0;
                 	while ($result=$getCategory->fetch_assoc()) {
                 		$x++;
				 ?>
						<tr class="odd gradeX">
							<td><?php echo $x; ?></td>
							<td><?php echo $result['catName']; ?></td>
							<td><a href="editcategory.php?catid=<?php echo $result['catId']; ?>">Edit</a> || <a onclick="return confirm('Do You want to Delete This')" href="?deleteCategory=<?php echo $result['catId']; ?>">Delete</a></td>
						</tr>
				<?php } }else{ echo "<span class='error'>The Category Not Fund</span>"; } ?>
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

