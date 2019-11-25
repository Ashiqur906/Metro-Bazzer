<?php include 'inc/header.php'; ?>
<?php 
$login=Session::get("customerLogin");
  	  if ($login==false) {
  	  	header("Location:login.php");
   }
?>
<style type="text/css">
.psuccess{width:450px;min-height:150px;text-align:center;border:1px solid #ddd;margin:0 auto;padding:20px;}
.psuccess h2{border-bottom:1px solid #ddd;margin-bottom:20px;padding-bottom:10px;color:green;}
.psuccess p{line-height:25px;font-size:15px;text-align:left;}
</style>
<div class="main">
  <div class="content">
	<div class="section group">
	   <div class="psuccess">
	   	<h2>Success</h2>
	   	<?php 
         $customerId=Session::get("customerId");
         $amount=$cart->payableAmount($customerId);
         if ($amount) {
         	$sum=0;
         	while ($result=$amount->fetch_assoc()) {
         		$price=$result['price'];
         		$sum=$sum+$price;
         	}
         }
	   	 ?>
	   	  <p style="color:red">Total Payable Amount.(With Accomulating Vat) : $
          <?php 
           $vat= $sum * 0.10;
           $total= $sum+$vat;
           echo $total;
           ?>
	   	  </p>
	   	  <p>Thanks For Buying This Product.Recieved Your Order Successfully.We will Contact With You As Soon As Possible With Deliver Details.Please Going to see your order detils....<a href="orderdetails.php">Visite Here</a></p>
	   </div>
	</div>
 </div>
</div>
<?php include 'inc/footer.php'; ?>