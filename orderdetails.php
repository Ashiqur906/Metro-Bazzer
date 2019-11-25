<?php include 'inc/header.php'; ?>
<?php 
$login=Session::get("customerLogin");
  	  if ($login==false) {
  	  	header("Location:login.php");
   }
?>
<?php 
if (isset($_GET['cusId'])) {
  $id=$_GET['cusId'];
  $time=$_GET['time'];
  $price=$_GET['price'];
  $confirm=$cart->confirmOrderProductShift($id, $time, $price);
 }
?>
<style type="text/css">
.tblone tr td{text-align:justify;}
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="order">
    			<h2 style="color:#134F7F; text-align:center;">Pls Going To See Your Order Details</h2>
          <table class="tblone">
            <tr>
              <th>No.</th>
              <th>Product Name</th>
              <th>Image</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Date</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          <?php 
           $customerId=Session::get("customerId");
           $getOrder=$cart->getOrderProduct($customerId);
           if ($getOrder) {
            $x=0;
            while ($result=$getOrder->fetch_assoc()) {
            $x++;
           ?>
            <tr>
              <td><?php echo $x; ?></td>
              <td><?php echo $result['productName']; ?></td>
              <td><img src="admin/<?php echo $result['image']; ?>" alt=""/></td>
              <td><?php echo $result['quantity']; ?></td>
              <td>$<?php echo $result['price'];  ?></td>
               <td><?php echo $fm->formatDate($result['date']); ?></td>
               <td>
                <?php 
                  if ($result['status']=='0') {
                   echo "Panding";
                  }elseif($result['status']=='1'){
                   echo "Shifted";
                }else{
                    echo "Ok";
                  }
                 ?>
               </td>
              <?php 
               if ($result['status']=='1') { ?>
              <td> <a href="?cusId=<?php echo $customerId; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['date']; ?>">Confirm</a></td>
              <?php }elseif($result['status']=='2'){ ?>
              <td>Ok</td>
              <?php }elseif($result['status']=='0'){ ?>
               <td>N/A</td>
              <?php } ?>
            </tr>
          <?php } } ?>
          </table>
    		</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>