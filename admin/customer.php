<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
$filepath=realpath(dirname(__FILE__));
include_once ($filepath.'/../classes/Customer.php');
?>
<?php 
$customer=new Customer();
if (!isset($_GET['customerId']) && $_GET['customerId']==NULL) {
    echo "<script>window.location='inbox.php'; </script>";
  //header("Location:catlist.php");
}else{
  $id = $_GET['customerId'];
  //use kora jay r na korleow hoy
  $id=preg_replace('/[^-a-zA-z0-9_]/', '', $_GET['customerId']);
}
?>
<!-- Category Update korar jonno and method ta ase(Category.php file) -->
<?php 
 if ($_SERVER["REQUEST_METHOD"] =="POST") {
   echo "<script>window.location='inbox.php'; </script>";
}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Customer Details</h2>
               <div class="block copyblock">
    
             <!-- Edit Category ta Redirate kore vashabe -->
             <?php 
             $customer=new Customer();
             $getcustomer=$customer->getCustomerById($id);
             if ($getcustomer) {
                 while ($result=$getcustomer->fetch_assoc()) {
              ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>Name</td>
                            <td>
                                <input type="text" value="<?php echo $result['name']; ?>" class="medium" readonly="readonly" />
                            </td>
                        </tr>
                         <tr>
                            <td>Address</td>
                            <td>
                                <input type="text" value="<?php echo $result['address']; ?>" class="medium" readonly="readonly" />
                            </td>
                        </tr>
                         <tr>
                            <td>City</td>
                            <td>
                                <input type="text" value="<?php echo $result['city']; ?>" class="medium" readonly="readonly" />
                            </td>
                        </tr>
                         <tr>
                            <td>Country</td>
                            <td>
                                <input type="text" value="<?php echo $result['country']; ?>" class="medium" readonly="readonly" />
                            </td>
                        </tr>
                         <tr>
                            <td>Zip</td>
                            <td>
                                <input type="text" value="<?php echo $result['zip']; ?>" class="medium" readonly="readonly" />
                            </td>
                        </tr>
                         <tr>
                            <td>Phone</td>
                            <td>
                                <input type="text" value="<?php echo $result['phone']; ?>" class="medium" readonly="readonly" />
                            </td>
                        </tr>
                         <tr>
                            <td>Email</td>
                            <td>
                                <input type="text" value="<?php echo $result['email']; ?>" class="medium" readonly="readonly" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Ok" />
                            </td>
                        </tr>
                    </table>
                    </form>
            <?php } }else{ echo "<span class='error'>The Category Not Fund.!</span>";} ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>