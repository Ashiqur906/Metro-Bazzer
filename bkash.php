<?php include 'inc/header.php'; ?>
<?php 
$login=Session::get("customerLogin");
  	  if ($login==false) {
  	  	header("Location:login.php");
   }
?>
<!-- Offline order & Payment Method(Cart class a ase method) -->
<?php 
if (isset($_GET['orderId']) && $_GET['orderId']=='order') {
	$customerId=Session::get("customerId");
	$insertOrder=$cart->productOrder($customerId);
	//jokhon payment ba order hobe tokhon toh r cart er data gula dekhar dorkar ni tai...ata header a logout option er majhee amon akto korsila ota neye asci
	$deleteData=$cart->deleteCustomerCart();
	header("Location:paymentsuccess.php");
}
 ?>
<style type="text/css">
.offline{width:50%;float:left;}
.tblone{width: 480px; margin: 0 auto; border: 2px solid #ddd;}
.tblone tr td{text-align: justify;}

.tbltwo{float:right;text-align:left;width:60%;border:2px solid #ddd;margin-right:0px;margin-top:4px;}
.tbltwo tr td{text-align: justify;padding:5px 10px;}
.ordernow{padding-bottom:30px;}
.ordernow a{width:100px;margin:20px auto 0;text-align:center;padding:5px;font-size:22px;display:block;background:#0D4777;color:#fff;border-radius:3px;height:25px;}
</style>
<div class="main">
  <div class="content">
	<div class="section group">
	   <div class="offline">
		
	   </div>
	   <div class="offline">
	   	 <?php 
         $id=Session::get("customerId");
         $getData=$customer->getCustomerData($id);
         if ($getData) {
         	while ($result=$getData->fetch_assoc()) {
    	 ?>
		<table class="tblone">
		   <tr>
		  	<td colspan="3"><h2 style="text-align: center;color: green;">Your Profile Details<hr></h2></td>
		  </tr>
		  <tr>
		  	<td width="20%">Name</td>
		  	<td width="5%">:</td>
		  	<td><?php echo $result['name']; ?></td>
		  </tr>
		  <tr>
		  	<td>Phone</td>
		  	<td>:</td>
		  	<td><?php echo $result['phone']; ?></td>
		  </tr>
		  <tr>
		  	<td>Email</td>
		  	<td>:</td>
		  	<td><?php echo $result['email']; ?></td>
		  </tr>
		  <tr>
		  	<td>Address</td>
		  	<td>:</td>
		  	<td><?php echo $result['address']; ?></td>
		  </tr>
		  <tr>
		  	<td>City</td>
		  	<td>:</td>
		  	<td><?php echo $result['city']; ?></td>
		  </tr>
		  <tr>
		  	<td>ZipCord</td>
		  	<td>:</td>
		  	<td><?php echo $result['zip']; ?></td>
		  </tr>
		  <tr>
		  	<td>Country</td>
		  	<td>:</td>
		  	<td><?php echo $result['country']; ?></td>
		  </tr>
		  <tr>
		  	<td></td>
		  	<td></td>
		  	<td><a href="editprofile.php">Update Details</a></td>
		  </tr>
		</table>
	<?php } } ?>
	   </div>
       
       <table class="tblone">
		   <tr>
		  	<td colspan="3"><h2 style="text-align: center;color: green;">Bkash Payment<hr></h2></td>
		  </tr>
		  <tr>
		  	<td width="20%">Bkash Number</td>
		  	<td width="5%">:</td>
		  	<td><input style="height:20px;margin-top:10px;" name="pass" type="password" placeholder="Enter Bkash Number"/></td>
		  </tr>
		  <tr>
		  	<td></td>
		  	<td></td>
		  	<td><a href="#">Submit</a></td>
		  </tr>
		</table>
	</div>
 </div>
 <div class="ordernow"><a href="?orderId=order">Order</a></div>
</div>
<?php include 'inc/footer.php'; ?>