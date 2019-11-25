<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
	$filepath=realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/Cart.php');
	$cart=new Cart();
	$fm=new Format();
?>
<?php 
//Cart file a method
if (isset($_GET['shiftId'])) {
	$id=$_GET['shiftId'];
	$time=$_GET['time'];
	$price=$_GET['price'];
	$confirmProduct=$cart->confirmOrderProduct($id, $time, $price);
 }
 ?>
 <?php 
if (isset($_GET['deleteId'])) {
	$id=$_GET['deleteId'];
	$time=$_GET['time'];
	$price=$_GET['price'];
	$delOrderProduct=$cart->DelConfirmOrderProduct($id, $time, $price);
 }
?>
<div class="grid_10">
    <div class="box round first grid">
    <h2>Inbox</h2>
   <?php 
   if (isset($confirmProduct)) {
   	  echo $confirmProduct;
   }

   if (isset($delOrderProduct)) {
   	  echo $delOrderProduct;
   }
    ?>
    <div class="block">        
        <table class="data display datatable" id="example">
		<thead>
			<tr>
				<th>ID</th>
				<th>Date & Time</th>
				<th>Product</th>
				<th>Quantity</th>
				<th>Price</th>
				<th>Customer Id</th>
				<th>Address</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php 
         $getOrder=$cart->getAllOrderProduct();
         if ($getOrder) {
         	while ($result=$getOrder->fetch_assoc()) {
		 ?>
			<tr class="odd gradeX">
			  <td><?php echo $result['id']; ?></td>
			  <td><?php echo $fm->formatDate($result['date']); ?></td>
			  <td><?php echo $result['productName']; ?></td>
			  <td><?php echo $result['quantity']; ?></td>
			  <td>$<?php echo $result['price']; ?></td>
			  <td><?php echo $result['customerId']; ?></td>
			  <td><a href="customer.php?customerId=<?php echo $result['customerId']; ?>">View Details</a></td>
			  <?php 
               if ($result['status'] =='0') { ?>
               	<td><a href="?shiftId=<?php echo $result['customerId']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date']; ?>">Shifted</a></td>
              <?php }elseif($result['status'] =='1'){ ?>
              <td>Panding</td>
              <?php }else{ ?>
                <td><a href="?deleteId=<?php echo $result['customerId']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date']; ?>">Removed</a></td>
              <?php }  ?>
			</tr>
		<?php } } ?>
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
