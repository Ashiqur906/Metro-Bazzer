<?php 
include 'lib/Session.php';
Session::init();
include 'lib/Database.php';
include 'helpers/Format.php';

spl_autoload_register(function($class){
   include_once"classes/".$class.".php";
});
$db=new Database();
$fm=new Format();
$product=new Product();
$category=new Category();
$cart=new Cart();
$customer=new Customer();
?>

<?php 
if (isset($_GET['productid'])) {
	$id=preg_replace('/[^-a-zA-z0-9_]/', '', $_GET['productid']);
}
?>

<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE HTML>
<head>
<title>Store Website</title>
<style type="text/css">
.success{
	color: green;
	font-size: 18px;
}
.error{
	color: red;
	font-size: 18px;
}


</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/logo.png" alt="" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form>
				    	<input type="text" value="Search for Products" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for Products';}"><input type="submit" value="SEARCH">
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="#" title="View my shopping cart" rel="nofollow">
								<span class="cart_title">Cart</span>
								<span class="no_product">
							     <?php 
							     $getData=$cart->checkTableDta();
							     if ($getData) {
							     	$sum=Session::get("sum");
							     	$TotalQuantity=Session::get("TotalQuantity");
                                    echo "$".$sum." |Qty: ".$TotalQuantity;
							     }else{
							     	echo "(Empty.!)";
							     }
							      ?>
							    </span>
							</a>
						</div>
			      </div>
	    <?php 
        if (isset($_GET['customerId'])) {
        	//Database thekow delete korbe er method
        	$deleteData=$cart->deleteCustomerCart();
        	Session::destroy();	
        }
	     ?>
		   <div class="login">
		    <?php 
			 $login=Session::get("customerLogin");
			  if ($login==false) { ?>
			  	<a href="login.php">Login</a>
			<?php }else{ ?>
                <a href="?customerId=<?php Session::get("customerId"); ?>">Logout</a>
		   <?php } ?>
		   </div>
           <div class="product-desc">
			<marquee style="color:green;">10% Discunt for all those product.</marquee>
	       </div>

		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Home</a></li>
	  <li><a href="topbrands.php">T-Brands</a></li>

	 <!-- Cart jokhon empty thakbr tahole cart manu er tokhon toh dorkar ni -->
	<?php 
     $chkCart=$cart->checkCart();
       if ($chkCart) { ?>
       	<li><a href="cart.php">Cart</a></li>
       	<li><a href="payment.php">Payment</a></li>
     <?php } ?>

     <!-- Jokhon order details a order er data thakne tokhon ata manu te show hobe -->
     <?php 
     $customerId=Session::get("customerId");
     $chkCustomerOrder=$cart->checkCOrder($customerId);
       if ($chkCustomerOrder) { ?>
       	<li><a href="orderdetails.php">Order</a></li>
     <?php } ?>

     <!-- Login hole profile manu asbe customer er -->
	<?php 
	$login=Session::get("customerLogin");
     if ($login==true) { ?>
     <li><a href="profile.php">Profile</a></li>
    <?php } ?>
      <li><a href="compare.php">Compare</a></li>
	  <li><a href="contact.php">Contact</a></li>

       <li><a href="#"><i class="fas fa-folder-open"></i> CATEGORIES</a>
			<ul>
					<ul>
						<?php 
                     $getCategory=$category->getAllcategory();
                     if ($getCategory) {
                     	while ($result=$getCategory->fetch_assoc()) {
					 ?>
				      <li><a href="productbycat.php?catId=<?php echo $result['catId']; ?>"><?php echo $result['catName']; ?></a></li>
				    <?php } } ?>
					</ul></li>
			</ul></li>

	  <div class="clear"></div>
	</ul>
</div>
	