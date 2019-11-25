<?php 
$filepath=realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
?>
<?php 
class Cart{
  private $db;
  private $fm;

  public function __construct(){
	$this->db = new Database();
	$this->fm = new Format();
	}

	public function addToCart($quantity, $id){
		$quantity=$this->fm->validation($quantity);
		//$id=$this->fm->validation($id);
		$quantity=mysqli_real_escape_string($this->db->link, $quantity);
		$productId=mysqli_real_escape_string($this->db->link, $id);
		$sId=session_id();

		$selectsql="SELECT * FROM tbl_product WHERE productId ='$productId'";
		$selectresult=$this->db->select($selectsql)->fetch_assoc();

		$productName=$selectresult['productName'];
		$price=$selectresult['price'];
		$image=$selectresult['image'];

		//same product buy korle dekhabe message je already add atar method($id ta kintu $productId te assign korsi..mind it)
		$check_sql="SELECT * FROM tbl_cart WHERE productId ='$productId' AND sId='$sId'";
		$query_getProduct=$this->db->select($check_sql);
		if ($query_getProduct) {
			$msg="The Product Is Already Added.!";
			return $msg;
		}else{
		$sql_product="INSERT INTO tbl_cart(sId, productId, productName, price, quantity, image)VALUES('$sId','$productId','$productName','$price','$quantity','$image')";
		$query_product=$this->db->insert($sql_product);
		if ($query_product) {
			header("Location:cart.php");
			}else{
				header("Location:404.php");
		  }
		}
	}

    //cart method...akhane session id ta unique heshabe dhora hoyse..cause onek customer verious browser theke product nete tai..tokhon tader oi session id database table a jabe unique hoye
	public function getCartProduct(){
		$sId=session_id();
		$sql_cart="SELECT * FROM tbl_cart WHERE sId='$sId'";
		$query_cart=$this->db->select($sql_cart);
		return $query_cart;
	}

	//Update cart quantity er method(cartId ta dhore)
	public function updateCartQuantity($cartId, $quantity){
		$cartId=$this->fm->validation($cartId);
		$quantity=$this->fm->validation($quantity);

		$cartId=mysqli_real_escape_string($this->db->link, $cartId);
		$quantity=mysqli_real_escape_string($this->db->link, $quantity);

		$sql_updateCart="UPDATE tbl_cart SET quantity='$quantity' WHERE cartId='$cartId'";
		$query_updateCart=$this->db->update($sql_updateCart);
		if ($query_updateCart) {
			header("Location:cart.php");
		}else{
			$msg="<span class='error'>The Quantity Not Updated.!</span>";
		    return $msg;
		}
	}

	public function deleteProductByCart($delete_id){
		$delete_id=mysqli_real_escape_string($this->db->link, $delete_id);
		$sql_delete="DELETE FROM tbl_cart WHERE cartId='$delete_id'";
		$query_delete=$this->db->delete($sql_delete);
		if ($query_delete) {
			echo "<script>window.location='cart.php';</script>";
		}else{
			$msg="<span class='error'>The Product Not Deleted.!</span>";
			return $msg;
		}
	}

	//emty cart show
	public function checkTableDta(){
		$sId=session_id();
		$sql_cart="SELECT * FROM tbl_cart WHERE sId='$sId'";
		$query=$this->db->select($sql_cart);
		return $query;
	}

	//Database thekow delete korbe er method
	public function deleteCustomerCart(){
        $sId=session_id();
        $sql="DELETE FROM tbl_cart WHERE sId='$sId'";
        $query=$this->db->delete($sql);
	}

	//Cart jokhon empty thakbr tahole cart manu er tokhon toh dorkar ni(ak kothay cart a jokhon empty hobe ota r menu te asbe na)
	public function checkCart(){
		$sId=session_id();
		$sql_cart="SELECT * FROM tbl_cart WHERE sId='$sId'";
		$query=$this->db->select($sql_cart);
		return $query;
	}

	//offline order & payment method
	public function productOrder($customerId){
        $sId=session_id();
		$sql_cart="SELECT * FROM tbl_cart WHERE sId='$sId'";
		$query_cart=$this->db->select($sql_cart);
		if ($query_cart) {
			while ($result=$query_cart->fetch_assoc()) {
                $productId=$result['productId'];
                $productName=$result['productName'];
                $quantity=$result['quantity'];
                $price=$result['price']* $quantity;
                $image=$result['image'];
        $sql_order="INSERT INTO tbl_order(customerId, productId, productName, quantity, price, image)VALUES('$customerId','$productId','$productName','$quantity','$price','$image')";
		$query_order=$this->db->insert($sql_order);
				
			}
		}	
	}
	//Payable Method
	public function payableAmount($customerId){
		$sql="SELECT price FROM tbl_order WHERE customerId='$customerId' AND date=now()";
		$query=$this->db->select($sql);
		return $query;
	}

	//Order Details
	public function getOrderProduct($customerId){
		$sql="SELECT * FROM tbl_order WHERE customerId='$customerId' order by date desc";
		$query=$this->db->select($sql);
		return $query;
	}

	//Jokhon order details a order er data thakbe tokhon ata manu te show hobe er method
	public function checkCOrder($customerId){
		$sql_cart="SELECT * FROM tbl_order WHERE customerId='$customerId'";
		$query=$this->db->select($sql_cart);
		return $query;
	}

	//admin er inbox file theke cart er customer er details method
	public function getAllOrderProduct(){
        $sql="SELECT * FROM tbl_order order by date desc";
		$query=$this->db->select($sql);
		return $query;
	}

	//Customer Producy order confirm method
	public function confirmOrderProduct($id, $date, $price){
        $id=$this->fm->validation($id);
		$date=$this->fm->validation($date);
		$price=$this->fm->validation($price);

		$id=mysqli_real_escape_string($this->db->link, $id);
		$date=mysqli_real_escape_string($this->db->link, $date);
		$price=mysqli_real_escape_string($this->db->link, $price);
		$sql="UPDATE tbl_order SET status='1' WHERE customerId='$id' AND date='$date' AND price='$price'";
		$query=$this->db->update($sql);
		if ($query) {
			$msg="<span class='success'>Updated Successfully.!</span>";
		    return $msg;
		}else{
			$msg="<span class='error'>Not Updated.!</span>";
		    return $msg;
		}
	}
	//Product peye gele customer sese delete kore debe
	public function DelConfirmOrderProduct($id, $time, $price){
        $id=$this->fm->validation($id);
        $time=$this->fm->validation($time);
        $price=$this->fm->validation($price);

		$id=mysqli_real_escape_string($this->db->link, $id);
		$time=mysqli_real_escape_string($this->db->link, $time);
		$price=mysqli_real_escape_string($this->db->link, $price);
		$sql_delete="DELETE FROM tbl_order WHERE customerId='$id' AND date='$time' AND price='$price'";
		$query_delete=$this->db->delete($sql_delete);
		if ($query_delete) {
			$msg="<span class='success'>Deleted Product Successfully.!</span>";
		    return $msg;
		}else{
			$msg="<span class='error'>Not Deleted.!</span>";
		    return $msg;
		}
	}
	//Confirm product shift
	public function confirmOrderProductShift($id, $time, $price){
        $id=$this->fm->validation($id);
		$time=$this->fm->validation($time);
		$price=$this->fm->validation($price);

		$id=mysqli_real_escape_string($this->db->link, $id);
		$time=mysqli_real_escape_string($this->db->link, $time);
		$price=mysqli_real_escape_string($this->db->link, $price);
		$sql="UPDATE tbl_order SET status='2' WHERE customerId='$id' AND date='$time' AND price='$price'";
		$query=$this->db->update($sql);
		if ($query) {
			$msg="<span class='success'>Updated Successfully.!</span>";
		    return $msg;
		}else{
			$msg="<span class='error'>Not Updated.!</span>";
		    return $msg;
		}
	}
}
?>