<?php 
$filepath=realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
?>
<?php 
class Customer{
  private $db;
  private $fm;
  
  public function __construct(){
	$this->db = new Database();
	$this->fm = new Format();
	}
//Customer Registration Method
  public function customerRegistration($data){
    $name=$this->fm->validation($data['name']);
    $address=$this->fm->validation($data['address']);
    $city=$this->fm->validation($data['city']);
    $country=$this->fm->validation($data['country']);
    $zip=$this->fm->validation($data['zip']);
    $phone=$this->fm->validation($data['phone']);
    $email=$this->fm->validation($data['email']);
    $pass=$this->fm->validation($data['pass']);

	$name=mysqli_real_escape_string($this->db->link, $data['name']);
	$address=mysqli_real_escape_string($this->db->link, $data['address']);
	$city=mysqli_real_escape_string($this->db->link, $data['city']);
	$country=mysqli_real_escape_string($this->db->link, $data['country']);
	$zip=mysqli_real_escape_string($this->db->link, $data['zip']);
	$phone=mysqli_real_escape_string($this->db->link, $data['phone']);
	$email=mysqli_real_escape_string($this->db->link, $data['email']);
	$pass=mysqli_real_escape_string($this->db->link, md5($data['pass']));

	if ($name=="" || $address=="" || $city=="" || $country=="" || $zip=="" || $phone=="" || $email=="" || $pass=="") {
		$msg="<span class='error'>All Fileds Are Must Not Be Empty.!</span>";
		return $msg;
	}
	$sql_mail="SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1";
	$query_mail=$this->db->select($sql_mail);
	if ($query_mail !=false) {
		$msg="<span class='error'>The Email Is Already Exist.!</span>";
		return $msg;
	}else{
		$sql_register="INSERT INTO tbl_customer(name, address, city, country, zip, phone, email, pass)VALUES('$name','$address','$city','$country','$zip','$phone','$email','$pass')";
		$query_register=$this->db->insert($sql_register);
		if ($query_register) {
			$msg="<span class='success'>The Customer Data Is Inserted Successfully.!</span>";
		    return $msg;
			}else{
			$msg="<span class='error'>The Customer Data not Inserted!</span>";
		    return $msg;
		  }
	}
  }

  //Customer Login Method
  public function customerLogin($data){
    $email=$this->fm->validation($data['email']);
    $pass=$this->fm->validation($data['pass']);

	$email=mysqli_real_escape_string($this->db->link, $data['email']);
	$pass=mysqli_real_escape_string($this->db->link, $data['pass']);
	if ($email=="" || $pass=="") {
		$msg="<span class='error'>All Fileds Are Must Not Be Empty.!</span>";
		return $msg;
	}
	$sql_login="SELECT * FROM tbl_customer WHERE email='$email' AND pass='$pass'";
	$result=$this->db->select($sql_login);
	if ($result !=false) {
		$value=$result->fetch_assoc();
		Session::set("customerLogin", true);
		Session::set("customerId", $value['id']);
		Session::set("customerName", $value['name']);
		header("Location:cart.php");
	}else{
		$msg="<span class='error'>Email And Password Not Matched.!</span>";
		return $msg;
	}
  }

  //Customer profile Method
  public function getCustomerData($id){
		$sql_customer="SELECT * FROM tbl_customer WHERE id='$id'";
		$query_customer=$this->db->select($sql_customer);
		return $query_customer;
  }

  //Customer Update Profile Method
  public function customerUpdateLogin($data,$customerId){
  	$name=$this->fm->validation($data['name']);
  	$address=$this->fm->validation($data['address']);
  	$city=$this->fm->validation($data['city']);
  	$country=$this->fm->validation($data['country']);
  	$zip=$this->fm->validation($data['zip']);
  	$phone=$this->fm->validation($data['phone']);
  	$email=$this->fm->validation($data['email']);

	$name=mysqli_real_escape_string($this->db->link, $data['name']);
	$address=mysqli_real_escape_string($this->db->link, $data['address']);
	$city=mysqli_real_escape_string($this->db->link, $data['city']);
	$country=mysqli_real_escape_string($this->db->link, $data['country']);
	$zip=mysqli_real_escape_string($this->db->link, $data['zip']);
	$phone=mysqli_real_escape_string($this->db->link, $data['phone']);
	$email=mysqli_real_escape_string($this->db->link, $data['email']);
	if ($name=="" || $address=="" || $city=="" || $country=="" || $zip=="" || $phone=="" || $email=="") {
		$msg="<span class='error'>Filds Are Must Not Be Empty.!</span>";
		return $msg;
	}else{
	  $sql="UPDATE tbl_customer SET name='$name', address='$address', city='$city', country='$country', zip='$zip', phone='$phone', email='$email' WHERE id='$customerId'";
	  $query=$this->db->update($sql);
	if ($query) {
	  $msg="<span class='success'>The Customer Profile Is Updated Successfully.!</span>";
	  return $msg;
	}else{
	  $msg="<span class='error'>The Customer Profile not Updated!</span>";
	  return $msg;
	    }
	 }   
  }

  //customer.php file er method
  public function getCustomerById($id){
		$sql_customer="SELECT * FROM tbl_customer WHERE id='$id'";
		$query_customer=$this->db->select($sql_customer);
		return $query_customer;
  }
}
?>