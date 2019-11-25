<?php include 'inc/header.php'; ?>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Compare</h2>
					<table class="tblone">
						<tr>
							<th>SL</th>
							<th>Product Name</th>
							<th>Price</th>
							<th>Image</th>
							<th>Action</th>
						</tr>
					<?php
					$product=new Product(); 
					//Product class a method
					 $customerId=Session::get("customerId");
                     $getProduct=$product->getCompaireData($customerId);
                     if ($getProduct) {
                     	$i=0;
                     	while ($result=$getProduct->fetch_assoc()) {
                     		$i++;
					    ?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $result['productName']; ?></td>
							<td><img src="admin/<?php echo $result['image']; ?>" alt=""/></td>
							<td><a href="details.php?productid=<?php echo $result['productId']; ?>">View</a></td>
						</tr>
					<?php } } ?>
					</table>
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

