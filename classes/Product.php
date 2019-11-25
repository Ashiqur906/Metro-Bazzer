<?php 
$filepath=realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
?>
<?php 
 class Product{
		private $db;
		private $fm;
		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}
	//ai method ta post er datagula $data deye and $FILES er gula $file deye dhorteci
	public function productInsert($data, $file){
		$productName=$this->fm->validation($data['productName']);
		$catId=$this->fm->validation($data['catId']);
		$brandId=$this->fm->validation($data['brandId']);
		$body=$this->fm->validation($data['body']);
		$price=$this->fm->validation($data['price']);
		$type=$this->fm->validation($data['type']);

		$productName=mysqli_real_escape_string($this->db->link, $data['productName']);
		$catId=mysqli_real_escape_string($this->db->link, $data['catId']);
		$brandId=mysqli_real_escape_string($this->db->link, $data['brandId']);
		$body=mysqli_real_escape_string($this->db->link, $data['body']);
		$price=mysqli_real_escape_string($this->db->link, $data['price']);
		$type=mysqli_real_escape_string($this->db->link, $data['type']);

		//oi je $file deye dhorteci
		$permited  = array('jpg', 'jpeg', 'png', 'gif');
		$file_name = $file['image']['name'];
		$file_size = $file['image']['size'];
		$file_temp = $file['image']['tmp_name'];

		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		$uploaded_image = "uploads/".$unique_image;

		if ($productName=="" || $catId=="" || $brandId=="" || $body=="" || $price=="" || $type=="") {
		$productmsg="<span class='error'>The Product must not be empty!</span>";
		return $productmsg;
		}elseif ($file_size >1048567) {
		 echo "<span class='error'>Image Size should be less then 1MB!
		 </span>";
		} elseif (in_array($file_ext, $permited) === false) {
		 echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
		}else{
		move_uploaded_file($file_temp, $uploaded_image);
		$sql_product="INSERT INTO tbl_product(productName, catId, brandId, body, price, image, type)VALUES('$productName','$catId','$brandId','$body','$price','$uploaded_image','$type')";
		$query_product=$this->db->insert($sql_product);
		if ($query_product) {
			$productmsg="<span class='success'>The Product Is Inserted Successfully.!</span>";
		    return $productmsg;
			}else{
				$productmsg="<span class='error'>The Product not Inserted!</span>";
			    return $productmsg;
		  }
		 }
	   }
		//Product vashar method
		public function getAllbrand(){
			/*assoic method
		     $sql_product="SELECT p.*, c.catName, b.brandName
		     FROM tbl_product as p, tbl_category as c, tbl_brand as b
		     WHERE p.catId=c.catId AND p.brandId=b.brandId
		     order by p.productId desc";
		    */
		    //ata general method==jeta valo lage otai korbo
			$sql_product="SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName 
			FROM tbl_product 
			INNER JOIN tbl_category 
			ON tbl_product.catId= tbl_category.catId 
			INNER JOIN tbl_brand 
			ON tbl_product.brandId= tbl_brand.brandId
			order by tbl_product.productId desc";
			$query_product=$this->db->select($sql_product);
			return $query_product;
		 }
		public function getProductById($id){
			$sql_product="SELECT * FROM tbl_product WHERE productId='$id'";
		    $query_product=$this->db->select($sql_product);
		    return $query_product;
		 }
		public function productUpdate($data, $file, $id){
			$productName=$this->fm->validation($data['productName']);
			$catId=$this->fm->validation($data['catId']);
			$brandId=$this->fm->validation($data['brandId']);
			$body=$this->fm->validation($data['body']);
			$price=$this->fm->validation($data['price']);
			$type=$this->fm->validation($data['type']);

			$productName=mysqli_real_escape_string($this->db->link, $data['productName']);
			$catId=mysqli_real_escape_string($this->db->link, $data['catId']);
			$brandId=mysqli_real_escape_string($this->db->link, $data['brandId']);
			$body=mysqli_real_escape_string($this->db->link, $data['body']);
			$price=mysqli_real_escape_string($this->db->link, $data['price']);
			$type=mysqli_real_escape_string($this->db->link, $data['type']);

			//oi je $file deye dhorteci
			$permited  = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $file['image']['name'];
			$file_size = $file['image']['size'];
			$file_temp = $file['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;
			if ($productName=="" || $catId=="" || $brandId=="" || $body=="" || $price=="" || $type=="") {
				$productmsg="<span class='error'>The Product must not be empty!</span>";
				return $productmsg;
		    }else{
			 if (!empty($file_name)) {
			if ($file_size >1048567) {
			    echo "<span class='error'>Image Size should be less then 1MB!
			     </span>";
			    }elseif (in_array($file_ext, $permited) === false) {
			     echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
			    }else{
				move_uploaded_file($file_temp, $uploaded_image);
				$sql_product="UPDATE tbl_product SET productName='$productName', catId='$catId', brandId='$brandId', body='$body', price='$price', image='$uploaded_image', type='$type' WHERE productId='$id'";

				$query_product=$this->db->update($sql_product);
				if ($query_product) {
					$productmsg="<span class='success'>The Product Is Updated Successfully.!</span>";
				    return $productmsg;
				}else{
					$productmsg="<span class='error'>The Updated not Inserted!</span>";
				    return $productmsg;
				    }
			     }
			}else{
				$sql_product="UPDATE tbl_product SET productName='$productName', catId='$catId', brandId='$brandId', body='$body', price='$price', type='$type' WHERE productId='$id'";

				$query_product=$this->db->update($sql_product);
				if ($query_product) {
					$productmsg="<span class='success'>The Product Is Updated Successfully.!</span>";
				    return $productmsg;
				}else{
					$productmsg="<span class='error'>The Updated not Inserted!</span>";
				    return $productmsg;
				    }
			}
		  }
	    }

//Delete Product Method
//ata oi image uploades file theke image ta delete korar way
    public function deleteProductById($id){
      $id=mysqli_real_escape_string($this->db->link, $id);
      $sql="SELECT * FROM tbl_product WHERE productId='$id'";
      $query=$this->db->select($sql);
      if ($query) {
      	while ($result=$query->fetch_assoc()) {
      		$delete_link=$result['image'];
      		unlink($delete_link);
      	}
      }
       //ata delete korar query akbare database theke
       $sql_delete="DELETE FROM tbl_product WHERE productId='$id'";
       $query_delete=$this->db->delete($sql_delete);
       if ($query_delete) {
			$msg="<span class='success'>The Product Is Deleted Successfully.!</span>";
			return $msg;
		}else{
			$msg="<span class='error'>The Product Not Deleted.!</span>";
			return $msg;
		}
    }
    //Index er product Featured gula vashabo
    public function getFeaturedProduct(){
       $sql="SELECT * FROM tbl_product WHERE type='0' order by productId desc LIMIT 4";
       $query=$this->db->select($sql);
       return $query;
    }
    // For New Product method
    public function getNewProduct(){
       $sql="SELECT * FROM tbl_product order by productId desc LIMIT 4";
       $query=$this->db->select($sql);
       return $query;
    }

    //Single product method
    public function getSingleProduct($id){
    	//assoic method
	     $sql_product="SELECT p.*, c.catName, b.brandName
	     FROM tbl_product as p, tbl_category as c, tbl_brand as b
	     WHERE p.catId=c.catId AND p.brandId=b.brandId AND p.productId='$id'";
	     $query_product=$this->db->select($sql_product);
		 return $query_product;
	     
	    /*ata general method==jeta valo lage otai korbo
		$sql_product="SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName 
		FROM tbl_product 
		INNER JOIN tbl_category 
		ON tbl_product.catId= tbl_category.catId 
		INNER JOIN tbl_brand 
		ON tbl_product.brandId= tbl_brand.brandId
		order by tbl_product.productId='$id'";
		$query_product=$this->db->select($sql_product);
		return $query_product;
		*/
    }

    //Slider er pase 4 ta latest product tar method
    public function latestFromIphone(){
       $sql="SELECT * FROM tbl_product WHERE brandId='1' order by productId desc LIMIT 1";
       $query=$this->db->select($sql);
       return $query;
    }

    public function latestFromSamsung(){
       $sql="SELECT * FROM tbl_product WHERE brandId='2' order by productId desc LIMIT 1";
       $query=$this->db->select($sql);
       return $query;
    }

    public function latestFromAcer(){
       $sql="SELECT * FROM tbl_product WHERE brandId='3' order by productId desc LIMIT 1";
       $query=$this->db->select($sql);
       return $query;
    }

    public function latestFromCanon(){
       $sql="SELECT * FROM tbl_product WHERE brandId='4' order by productId desc LIMIT 1";
       $query=$this->db->select($sql);
       return $query;
    }

    //ProductByCategory er method
    public function productByCat($id){
    	$id=mysqli_real_escape_string($this->db->link, $id);
    	$sql_product="SELECT * FROM tbl_product WHERE catId='$id'";
		$query_product=$this->db->select($sql_product);
		return $query_product;
    }

    public function insertCompaireData($customerId,$compireId){
    	$customerId=mysqli_real_escape_string($this->db->link, $customerId);
    	$productId=mysqli_real_escape_string($this->db->link, $compireId);

    	$sql_CheckCompire="SELECT * FROM tbl_compare WHERE customerId='$customerId' AND productId='$productId'";
    	$query_ChackCompire=$this->db->select($sql_CheckCompire);
    	if ($query_ChackCompire) {
    		$msg="<span class='error'>This Is Already Add.!</span>";
			return $msg;
    	}
    	$sql="SELECT * FROM tbl_product WHERE productId='$productId'";
		$result=$this->db->select($sql)->fetch_assoc();
		if ($result) {
            $productId=$result['productId'];
            $productName=$result['productName'];
            $price=$result['price'];
            $image=$result['image'];
        $sql_compaire="INSERT INTO tbl_compare(customerId, productId, productName, price, image)VALUES('$customerId','$productId','$productName','$price','$image')";
		$query_compire=$this->db->insert($sql_compaire);

		if ($query_compire) {
		    $msg="<span class='success'>Add To Compaire.!</span>";
			return $msg;
		}else{
			$msg="<span class='error'>Not Add To Compaire.!</span>";
			return $msg;
		  }	
		}
    }

    // Compaire file er data vasha 
    public function getCompaireData($customerId){
    	$sql="SELECT * FROM tbl_compare WHERE customerId='$customerId'";
    	$query=$this->db->select($sql);
    	return $query;
    }	
}
?>