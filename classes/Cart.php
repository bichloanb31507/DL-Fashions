<?php 
 $filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
 
?>
<?php
 
 class Cart{
     
     private $db;
     private $fm;
 
     public	function __construct(){
        $this->db   = new Database();
        $this->fm   = new Format();
     }
 
 
      public function addToCart($quantity, $id){
     $quantity = $this->fm->validation($quantity);
     $quantity =  mysqli_real_escape_string($this->db->link, $quantity);
     $productId =  mysqli_real_escape_string($this->db->link, $id);
     $sId = session_id();
 
     $squery = "SELECT * FROM products WHERE id = '$productId'";
     $result = $this->db->select($squery)->fetch_assoc();
 
     $productName = $result['name'];
     $price = $result['price'];
     $image = $result['image'];
 
 
     $chquery = "SELECT * FROM cart WHERE pro_id = '$productId' AND sid ='$sId'";
     $getPro = $this->db->select($chquery);
     if ($getPro) {
         $msg = "Product Already Added!";
         return $msg;
     }else {
 
     $query = "INSERT INTO cart(sid, pro_id, pro_name, price, quantity, image) 
           VALUES ('$sId','$productId','$productName','$price','$quantity','$image')";  
 
           $inserted_row = $this->db->insert($query);
           if ($inserted_row) {
                  header("Location:cart.php");
             }else {
                 header("Location:404.php");
             } 
  }
      }
 
 
   public function getCartProduct(){
       $sId = session_id();
       $query = "SELECT * FROM cart WHERE sid ='$sId' ";
          $result = $this->db->select($query);
          return $result;
 
   }
 
 
   public function updateCartQuantity($cartId, $quantity){
        $cartId =  mysqli_real_escape_string($this->db->link, $cartId ); 
      $quantity =  mysqli_real_escape_string($this->db->link, $quantity );
 
     $query = "UPDATE cart
                 SET
                 quantity = '$quantity'
                 WHERE id = '$cartId' ";
                 $update_row  = $this->db->update($query);
                 if ($update_row) {
                      header("Location:cart.php");
                 }else {
                     $msg = "<span class='error'>Quantity Not Updated .</span> ";
                     return $msg;
                 } 
   }
 
  public function delProductByCart($delId) {
  $delId =  mysqli_real_escape_string($this->db->link, $delId ); 
  $query = "DELETE FROM cart WHERE id ='$delId' ";
           $deldata = $this->db->delete($query);
           if ($deldata) {
               echo "<script>window.location = 'cart.php';</script> ";
           
           }else {
               $msg = "<span class='error'>Product Not Deleted .</span> ";
                  return $msg;
               }
 
 
  }
 
 
  public function checkCartTable(){
      $sId = session_id();
   $query = "SELECT * FROM cart WHERE sid ='$sId' ";
      $result = $this->db->select($query);
      return $result;
  }
 
 
  public function delCustomerCart() {
   $sId = session_id();
   $query = "DELETE FROM cart WHERE sid ='$sId'";
   $this->db->delete($query);
  
  }
 
    public function orderProduct($cmrId){
   $sId = session_id();
   $query = "SELECT * FROM cart WHERE sid ='$sId' ";
   $getPro = $this->db->select($query);
    if ($getPro) {
    while ($result = $getPro->fetch_assoc()) {
      $productId     = $result['pro_id'];
      $productName   = $result['pro_name'];
      $quantity      = $result['quantity'];
      $price         = $result['price'];
      $image         = $result['image'];
 
       $query = "INSERT INTO orders(cus_id, pro_id, pro_name, quantity, price, image) 
       VALUES ('$cmrId','$productId','$productName','$quantity','$price','$image')";  
           $inserted_row = $this->db->insert($query); 

      }
    } 
 
    }
 
 
   public function getOrderProduct($cmrId){
   $query = "SELECT * FROM orders WHERE s ='$cmrId' ORDER BY productId DESC ";
   $result = $this->db->select($query);
   return $result;
 
   }
 
 
  public function checkOrder($cmrId){
  $query = "SELECT * FROM orders WHERE cmrId ='$cmrId' ";
   $result = $this->db->select($query);
   return $result;
 
  }
 
 
 
    public function getAllOrderProduct(){
   $query = "SELECT * FROM tbl_order ORDER BY date ";
   $result = $this->db->select($query);
   return $result;
 
    }
 
  public function productShifted($id,$date,$price){
   $id =  mysqli_real_escape_string($this->db->link, $id ); 
   $date =  mysqli_real_escape_string($this->db->link, $date ); 
   $price =  mysqli_real_escape_string($this->db->link, $price ); 
   $query = "UPDATE tbl_order
                 SET
                 status = '1'
                 WHERE cmrId = '$id' AND date='$date' AND price='$price'";
                 $update_row  = $this->db->update($query);
                 if ($update_row) {
                    $msg = "<span class='success'>Updated Successfully.</span> ";
               return $msg;
                 }else {
                   $msg = "<span class='error'>Not Updated .</span> ";
               return $msg;
                 } 
  
  }
 
 
  public function delproductShifted($id,$time,$price){
   $id =  mysqli_real_escape_string($this->db->link, $id ); 
   $date =  mysqli_real_escape_string($this->db->link, $time ); 
   $price =  mysqli_real_escape_string($this->db->link, $price ); 
   $query = "DELETE FROM tbl_order WHERE cmrId = '$id' AND date='$date' AND price='$price'";
         $deldata = $this->db->delete($query);
         if ($deldata) {
           $msg = "<span class='success'>Data Deleted Successfully.</span> ";
         return $msg;
         }else {
           $msg = "<span class='error'>Data Not Deleted .</span> ";
              return $msg;
           }
 
 
  }
 
 }
 
?>