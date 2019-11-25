<?php include 'inc/header.php'; ?>
<?php 
if (isset($_GET['productid'])) {
	$id=preg_replace('/[^-a-zA-z0-9_]/', '', $_GET['productid']);
}
?>
<!-- Brand Update korar jonno and method ta ase(Category.php file) -->
<?php 
     if ($_SERVER["REQUEST_METHOD"] =="POST" && isset($_POST['submit'])) {
        $quantity =$_POST['quantity'];
        $addCart=$cart->addToCart($quantity, $id);
    }
?>
<?php 
$customerId=Session::get("customerId");
if ($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['compaire'])) {
	$productId =$_POST['productId'];
	$insertCompaire=$product->insertCompaireData($productId,$customerId);
}
?>
 <div class="main">
    <div class="content">
    	<div class="section group">
		<div class="cont-desc span_1_of_2">	
         <?php 
         $getProduct=$product->getSingleProduct($id);
         if ($getProduct) {
         	while ($result=$getProduct->fetch_assoc()) {
          ?>
				  <div class="grid images_3_of_2">
					<img src="admin/<?php echo $result['image']; ?>" alt="" />
				  </div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result['productName']; ?></h2>					
					<div class="price">
						<p>Price: <span>$<?php echo $result['price']; ?></span></p>
						<p>Category: <span><?php echo $result['catName']; ?></span></p>
						<p>Brand:<span><?php echo $result['brandName']; ?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
					</form>				
				</div>
				<span style="color: red;font-size: 18px;">
				<?php 
                 if (isset($addCart)) {
                 	echo  $addCart;
                 }
				 ?>	
				</span>
				<?php 
                 if (isset($insertCompaire)) {
                 	echo $insertCompaire;
                 }
				 ?>	
			    <div class="add-cart">
					<form action="" method="post">
					<input type="hidden" class="buyfield" name="productId" value="<?php echo $result['productId']; ?>"/>
					<input type="submit" class="buysubmit" name="compaire" value="Add To Compare"/>
					</form>				
				</div>
			</div>
		<div class="product-desc">
			<h2>Product Details</h2>
			<?php echo $result['body']; ?>
	    </div>
	<?php } } ?>
				
	   </div>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
					<?php 
                     $getCategory=$category->getAllcategory();
                     if ($getCategory) {
                     	while ($result=$getCategory->fetch_assoc()) {
					 ?>
				      <li><a href="productbycat.php?catId=<?php echo $result['catId']; ?>"><?php echo $result['catName']; ?></a></li>
				    <?php } } ?>
    				</ul>
 				</div>
 		</div>
 	</div>
	</div>
   <?php include 'inc/footer.php'; ?>

