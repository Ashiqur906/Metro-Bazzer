<?php include 'inc/header.php'; ?>
<?php 
$login=Session::get("customerLogin");
  	  if ($login==false) {
  	  	header("Location:login.php");
   }
?>
<style type="text/css">
.payment{width:450px;min-height:150px;text-align:center;border:1px solid #ddd;margin:0 auto;padding:47px;}
.payment h2{border-bottom:1px solid #ddd;margin-bottom:38px;padding-bottom:10px;}
.payment a{background:#094270 none repeat scroll 0 0;color:#fff;font-size:20px;padding:5px 25px;border-radius:4px;}
.back{width:150px;margin:5px auto 0;padding:7px 0;text-align:center;display:block;background:#555;border:1px solid #333;color:green;border-radius:4px;font-size:20px;}
</style>
<div class="main">
  <div class="content">
	<div class="section group">
	   <div class="payment">
	   	<h2>Choose Desire Payment Option</h2>
	   	 <a href="offlinepayment.php">Offline Payment</a>
	   	 <a href="bkash.php">Bkash Payment</a>
	   </div>
	   <div class="back">
	   	<a href="cart.php">Previous</a>
	   </div>
	</div>
 </div>
</div>
<?php include 'inc/footer.php'; ?>