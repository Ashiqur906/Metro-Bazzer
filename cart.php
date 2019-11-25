<?php include 'inc/header.php'; ?>
<!-- deleteId dhore -->
<?php 
if (isset($_GET['deleteId'])) {
	$delete_id=preg_replace('/[^-a-zA-z0-9_]/', '', $_GET['deleteId']);
	$deleteProduct=$cart->deleteProductByCart($delete_id);
}

?>
<?php 
if ($_SERVER["REQUEST_METHOD"]=="POST") {
	$cartId=$_POST['cartId'];
	$quantity=$_POST['quantity'];
	$updateCart=$cart->updateCartQuantity($cartId, $quantity);
	//ai condition ta cartId deye krte hobe cause update er akhane korsi tai
	if ($quantity <=0) {
		$deleteProduct=$cart->deleteProductByCart($cartId);
	}
}
 ?>
<!-- For page Refress Method -->
<?php 
if (!isset($_GET['refress'])) {
	echo "<meta http-equiv='refresh' content='0;URL=?refress=project'/>";
}
 ?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
			    <?php 
                 if (isset($updateCart)) {
                 	echo $updateCart;
                 }
                 //Delete colled
                 if (isset($deleteProduct)) {
                 	echo $deleteProduct;
                 }
			     ?>
					<table class="tblone">
						<tr>
							<th width="5%">SL</th>
							<th width="30%">Product Name</th>
							<th width="15%">Image</th>
							<th width="15%">Price</th>
							<th width="20%">Quantity</th>
							<th width="15%">Total Price</th>
							<th width="10%">Action</th>
						</tr>
					<?php 
                     $getProduct=$cart->getCartProduct();
                     if ($getProduct) {
                     	$x=0;
                     	$sum=0;
                     	$TotalQuantity=0;
                     	while ($result=$getProduct->fetch_assoc()) {
                     	$x++;
					 ?>
						<tr>
							<td><?php echo $x; ?></td>
							<td><?php echo $result['productName']; ?></td>
							<td><img src="admin/<?php echo $result['image']; ?>" alt=""/></td>
							<td>$<?php echo $result['price']; ?></td>
							<td>
								<form action="" method="post">
									<input type="hidden" name="cartId" value="<?php echo $result['cartId']; ?>"/>
									<input type="number" name="quantity" value="<?php echo $result['quantity']; ?>"/>
									<input type="submit" name="submit" value="Update"/>
								</form>
							</td>
							<td>$<?php 
							$total=$result['price'] * $result['quantity'];
							  echo $total; 
							?></td>
							<td><a onclick="return confirm('Do You Want To Delete This.!');" href="?deleteId=<?php echo $result['cartId']; ?>">X</a></td>
						</tr>
					<?php 
					$TotalQuantity=$TotalQuantity+$result['quantity'];
                    $sum=$sum+$total;
                    Session::set("TotalQuantity", $TotalQuantity);
                    Session::set("sum", $sum);

					 ?>
					<?php } } ?>
					</table>
					<?php 
					 $getData=$cart->checkTableDta();
                     if ($getData) {
					 ?>
					<table style="float:right;text-align:left;" width="40%">
						<tr>
							<th>Gross Pay : </th>
							<td>$<?php echo $sum; ?></td>
						</tr>
						<tr>
							<th>VAT : </th>
							<td>10%</td>
						</tr>
						<tr>
							<th>Net Pay :</th>
							<td>$
								<?php 
                                 $vat=$sum * 0.10;
                                 $netPay=$vat + $sum;
                                 echo $netPay;
								 ?>	
							 </td>
						</tr>
				   </table>
					<?php  }else{
						header("Location:index.php");
                     //echo "The Cart Is Emty.Please Right Now Shopping.!";
					 }?>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>

