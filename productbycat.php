<?php include 'inc/header.php'; ?>
<?php 
//details file theke catId dhora hoyse
if (!isset($_GET['catId']) && $_GET['catId']==NULL) {
    echo "<script>window.location='404.php'; </script>";
  //header("Location:catlist.php");
}else{
  $id = $_GET['catId'];
  //use kora jay r na korleow hoy
  $id=preg_replace('/[^-a-zA-z0-9_]/', '', $_GET['catId']);
}
?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Latest from Category</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	    <?php 
	    //Product.php file er method
        $productByCategory=$product->productByCat($id);
        if ($productByCategory) {
        	while ($result=$productByCategory->fetch_assoc()) {
	    ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?productid=<?php echo $result['productId']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					 <h2><?php echo $result['productName']; ?></h2>
					 <p><?php echo $fm->readMore_Text($result['body'], 40); ?></p>
					 <p><span class="price">$<?php echo $result['price']; ?></span></p>
				     <div class="button"><span><a href="details.php?productid=<?php echo $result['productId']; ?>" class="details">Details</a></span></div>
				</div>
		<?php } }else{
			header("Location:404.php");
			//echo "<p>The Products are not available in this category.!</p>";
		} ?>
		  </div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>

