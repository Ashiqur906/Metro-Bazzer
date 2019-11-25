<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php'; ?>
<?php 
$brand = new Brand();
if (!isset($_GET['brandid']) && $_GET['brandid']==NULL) {
    echo "<script>window.location='brandlist.php'; </script>";
  //header("Location:catlist.php");
}else{
  $id = $_GET['brandid'];
  //use kora jay r na korleow hoy
  $id=preg_replace('/[^-a-zA-z0-9_]/', '', $_GET['brandid']);
}
?>
<!-- Brand Update korar jonno and method ta ase(Category.php file) -->
<?php 
     if ($_SERVER["REQUEST_METHOD"] =="POST") {
        $brandName =$_POST['brandName'];
        $update_brand=$brand->updateBrand($brandName, $id);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Brand</h2>
               <div class="block copyblock"> 

            <!-- category Update Message akhane dekhalam ar jonno -->
            <?php 
             if (isset($update_brand)) {
                echo $update_brand;
             }
             ?>
             <!-- Edit Category ta Redirate kore vashabe -->
             <?php 
             $getBrand=$brand->getBrandById($id);
             if ($getBrand) {
                 while ($result=$getBrand->fetch_assoc()) {
              ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['brandName']; ?>" class="medium" name="brandName" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
            <?php } }else{ echo "<span class='error'>The Brand Not Fund.!</span>";} ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>