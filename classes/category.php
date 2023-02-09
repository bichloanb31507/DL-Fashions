<?php
 $filepath = realpath(dirname(__FILE__));
 include_once ($filepath.'/../lib/database.php');  
 include_once ($filepath.'/../helpers/format.php');  
?>
<?php 
class Category{
    private $db;  // Database class property 
    private $fm;  // Format class property 
    public function __construct(){
        $this->db   = new Database(); // Object for Database Class
        $this->fm   = new Format();   // Object for Format Class
    }

    public function addcategory($cateName,$cateDescription){
        $cateName = $this->fm->validation($cateName);
        $cateDescription = $this->fm->validation($cateDescription);
        $cateName = mysqli_real_escape_string($this->db->link,$cateName);
        $cateDescription = mysqli_real_escape_string($this->db->link,$cateDescription);
        if(empty($cateName)|| empty($cateDescription)){
            $loginmsg="name or description mustn't be empty";
            return $loginmsg;
        }else{
            $query = "INSERT INTO categories values (NULL, '$cateName','$cateDescription')";
    		$result = $this->db->insert($query);
    		if ($result) {
    			$loginmsg = "Insert category successfully!! ";
    			return $loginmsg;
    			
    		}else {
    			$loginmsg = "Insert failed!! ";
    			return $loginmsg; 
    		}
        }

    }
    public function editcategory($cateName,$cateDescription,$cateid){
        $cateName = $this->fm->validation($cateName);
        $cateDescription = $this->fm->validation($cateDescription);
        $cateName = mysqli_real_escape_string($this->db->link,$cateName);
        $cateDescription = mysqli_real_escape_string($this->db->link,$cateDescription);
        if(empty($cateName)||empty($cateDescription)){
            $loginmsg="name or description mustn't be empty";
            return $loginmsg;
        }else{
            $query = "UPDATE `categories` SET `name`='$cateName',`description`='$cateDescription' WHERE `id`='$cateid'";
    		$result = $this->db->update($query);
    		if ($result) {
    			$loginmsg = "Update category successfully!! ";
    			return $loginmsg;
    			
    		}else {
    			$loginmsg = "Update failed!! ";
    			return $loginmsg; 
    		}
        }

    }
    public function cateList(){
        $query = "Select * from categories";
    		$result = $this->db->select($query);
            return $result;
    }
    public function getcateid($id){
        $query = "Select * from categories where id='$id'";
    		$result = $this->db->select($query);
            return $result;
    }
    public function delcategory($id){
        $query = "delete from categories where id='$id'";
    		$result = $this->db->delete($query);
            if ($result) {
    			$loginmsg = "delete category successfully!! ";
    			return $loginmsg;
    			
    		}else {
    			$loginmsg = "delete failed!! ";
    			return $loginmsg; 
    		}
    }
}
?>