<?php 
$filepath=realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
?>
<?php 
class Category{
   private $db;
   private $fm;

  public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function categoryInsert($catName){
		$catName=$this->fm->validation($catName);
		$catName=mysqli_real_escape_string($this->db->link, $catName);
		if ($catName=="") {
			$categorymsg="<span class='error'>The Category must not be empty!</span>";
			return $categorymsg;
		}else{
			$sql_category="INSERT INTO tbl_category(catName)VALUES('$catName')";
			$query_category=$this->db->insert($sql_category);
			if (isset($query_category)) {
				$categorymsg="<span class='success'>The Category Is Inserted Successfully !</span>";
				return $categorymsg;
			}else{
				$categorymsg="<span class='error'>The Category Not Inserted !</span>";
				return $categorymsg;
			}
		}
	}
	//category vashar jono method
    //Category method o ase(akbare 2 tai jenish)
	public function getAllcategory(){
		 $sql="SELECT * FROM tbl_category order by catId desc";
         $query=$this->db->select($sql);
         return $query;
	}

	public function getCategoryById($id){
        $sql="SELECT * FROM tbl_category WHERE catId='$id'";
        $query=$this->db->select($sql);
        return $query;
	}
     
     //Update method
	public function updateCategory($catName, $id){
		$catName=$this->fm->validation($catName);
		$id=mysqli_real_escape_string($this->db->link, $id);

		if (empty($catName)) {
			$msg="<span class='error'>The Category Field Must Not Be Empty.!</span>";
			return $msg;
		}else{
			$sql_updateCategory="UPDATE tbl_category SET catName='$catName' WHERE catId='$id'";
			$query_updateCategory=$this->db->update($sql_updateCategory);

			if ($query_updateCategory) {
				$msg="<span class='success'>The Category Is Updated Successfully.!</span>";
			    return $msg;
			}else{
				$msg="<span class='error'>The Category Not Updated.!</span>";
			    return $msg;
			}
		}
	}

	// Delete Category method
	public function deleteCatById($id){
		$id=mysqli_real_escape_string($this->db->link, $id);
		$sql_delete="DELETE FROM tbl_category WHERE catId='$id'";
		$query_deleteCategory=$this->db->delete($sql_delete);
		if ($query_deleteCategory) {
			$msg="<span class='success'>The Category Is Deleted Successfully.!</span>";
			return $msg;
		}else{
			$msg="<span class='error'>The Category Not Deleted.!</span>";
			return $msg;
		}
	}
}
 ?>