<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Category.php'; ?>
<?php 
$cat = new Category();
if (!isset($_GET['catId']) && $_GET['catId']==NULL) {
    echo "<script>window.location='catlist.php'; </script>";
  //header("Location:catlist.php");
}else{
  $id = $_GET['catId'];
  //use kora jay r na korleow hoy
  $id=preg_replace('/[^-a-zA-z0-9_]/', '', $_GET['catId']);
}
?>
<!-- Category Update korar jonno and method ta ase(Category.php file) -->
<?php 
     if ($_SERVER["REQUEST_METHOD"] =="POST") {
        $catName =$_POST['catName'];
        $update_category=$cat->updateCategory($catName, $id);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock"> 

            <!-- category Update Message akhane dekhalam ar jonno -->
            <?php 
             if (isset($update_category)) {
                echo $update_category;
             }
             ?>
             <!-- Edit Category ta Redirate kore vashabe -->
             <?php 
             $getcategory=$cat->getCategoryById($id);
             if ($getcategory) {
                 while ($result=$getcategory->fetch_assoc()) {
              ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['catName']; ?>" class="medium" name="catName" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
            <?php } }else{ echo "<span class='error'>The Category Not Fund.!</span>";} ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>