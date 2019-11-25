<?php 
$filepath=realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
?>
<?php 
class Brand{
   private $db;
   private $fm;
  public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function brandInsert($brandName){
		$brandName=$this->fm->validation($brandName);
		$brandName=mysqli_real_escape_string($this->db->link, $brandName);
		if ($brandName=="") {
			$brandmsg="<span class='error'>The Brand Name must not be empty!</span>";
			return $brandmsg;
		}else{
			$sql_brand="INSERT INTO tbl_brand(brandName)VALUES('$brandName')";
			$query_brand=$this->db->insert($sql_brand);
			if (isset($query_brand)) {
				$brandmsg="<span class='success'>The Brand Name Is Inserted Successfully !</span>";
				return $brandmsg;
			}else{
				$brandmsg="<span class='error'>The Brand Name Not Inserted !</span>";
				return $brandmsg;
			}
		}
	}
//brand vashar method
	public function getAllbrand(){
		$sql_brand="SELECT * FROM tbl_brand order by brandId desc";
		$query_brand=$this->db->select($sql_brand);
		return $query_brand;
	}

	public function getBrandById($id){
        $sql_brand="SELECT * FROM tbl_brand WHERE brandId='$id'";
        $query_brand=$this->db->select($sql_brand);
        return $query_brand;
	}
//brand update method
	public function updateBrand($brandName, $id){
        $brandName=$this->fm->validation($brandName);
		$brandName=mysqli_real_escape_string($this->db->link, $brandName);
		$id=mysqli_real_escape_string($this->db->link, $id);

		if (empty($brandName)) {
			$msg="<span class='error'>The Brand Field Must Not Be Empty.!</span>";
			return $msg;
		}else{
			$sql_updateBrand="UPDATE tbl_brand SET brandName='$brandName' WHERE brandId='$id'";
			$query_updateBrand=$this->db->update($sql_updateBrand);

			if ($query_updateBrand) {
				$msg="<span class='success'>The Brand Is Updated Successfully.!</span>";
			    return $msg;
			}else{
				$msg="<span class='error'>The Brand Not Updated.!</span>";
			    return $msg;
			}
		}
	}

	//delete Brand Method
	public function deleteBrandById($id){
		$id=mysqli_real_escape_string($this->db->link, $id);
		$sql_delete="DELETE FROM tbl_brand WHERE brandId='$id'";
		$query_deleteBrand=$this->db->delete($sql_delete);
		if ($query_deleteBrand) {
			$msg="<span class='success'>The Brand Name Is Deleted Successfully.!</span>";
			return $msg;
		}else{
			$msg="<span class='error'>The Brand Name Not Deleted.!</span>";
			return $msg;
		}
	}
}
?>