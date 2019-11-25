<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Product.php';?>
<?php include_once '../helpers/Format.php'; ?>
<?php 
$product=new Product();
$fm=new Format();
?>
<?php 
   if (isset($_GET['deleteBroduct'])) {
   	  $id=$_GET['deleteBroduct'];
   	  $id=preg_replace('/[^-a-zA-z0-9_]/', '', $_GET['deleteBroduct']);
   	  $deleteId=$product->deleteProductById($id);
   }
 ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Product List</h2>
        <div class="block">  
        <?php 
         if (isset($deleteId)) {
         	echo $deleteId;
         }

         ?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>SL.</th>
					<th>Product Name</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Price</th>
					<th>Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
		<?php 
         $getProduct=$product->getAllbrand();
          if ($getProduct) {
          	$x=0;
          	while ($result=$getProduct->fetch_assoc()) {
          		$x++;
		 ?>
				<tr class="odd gradeX">
					<td><?php echo $x; ?></td>
					<td><?php echo $result['productName']; ?></td>
					<td><?php echo $result['catName']; ?></td>
					<td><?php echo $result['brandName']; ?></td>
					<td><?php echo $fm->readMore_Text($result['body'], 30); ?></td>
					<td>$<?php echo $result['price']; ?></td>
					<td><img src="<?php echo $result['image']; ?>" height="40px" width="60px"></td>
					<td>
						<?php 
						if ($result['type']==0) {
							echo "Featured";
						}else{
							echo "General";
						}
						?>	
					</td>
					<td><a href="productedit.php?productid=<?php echo $result['productId']; ?>">Edit</a> || <a onclick="return confirm('Do You want to Delete This')" href="?deleteBroduct=<?php echo $result['productId']; ?>">Delete</a></td>
				</tr>
		<?php } }else{ echo "<span class='error'>The Product Not Fund In Here</span>";} ?>
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
