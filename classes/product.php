<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');

?>
<?php
class Product
{
    private $db; // Database class property 
    private $fm; // Format class property 
    public function __construct()
    {
        $this->db = new Database(); // Object for Database Class
        $this->fm = new Format(); // Object for Format Class
    }

    public function addproduct($data, $files)
    {
        $proName = mysqli_real_escape_string($this->db->link, $data['proName']);
        $cate = mysqli_real_escape_string($this->db->link, $data['cate']);
        $proDescription = mysqli_real_escape_string($this->db->link, $data['proDescription']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);
        //kiem tra hinh anh va lay hinh anh cho vào folder upload
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];
        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if (empty($proName) || empty($cate) || empty($proDescription) || empty($price) || empty($type)) {
            $msg = "fiels mustn't be empty";
            return $msg;
        } else {
            $query = "INSERT INTO products values (NULL, '$proName','$cate','$price','$proDescription','$unique_image','$type')";
            $result = $this->db->insert($query);
            if ($result) {
                $msg = "Insert product successfully!! ";
                return $msg;

            } else {
                $msg = "Insert failed!! ";
                return $msg;
            }
        }

    }
    public function editproduct($data, $file, $id)
    {

        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $catId = mysqli_real_escape_string($this->db->link, $data['catId']);
        $description = mysqli_real_escape_string($this->db->link, $data['description']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);

        $permited = array('jpg', 'png', 'jpeg', 'gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;
        if ($productName == "" || $catId == "" || $description == "" || $price == "" || $type == "") {
            $msg = "<span class='error'>Field Must Not be empty .</span> ";
            return $msg;
        } else {
            if (!empty($file_name)) {
                if ($file_size > 1054589) {
                    echo "<span class='error'>Image Size should be less then 1MB .</span>";
                } elseif (in_array($file_ext, $permited) === false) {
                    echo "<span class='error'> You can Upload Only" . implode(',', $permited) . "</span>";


                } else {
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "UPDATE products
              SET 
              name 	= '$productName',
              cate_id 		= '$catId',
              description 			= '$description',
              price 		= '$price',
              image 		= '$uploaded_image',
              type 			= '$type'
              WHERE id = '$id' ";


                    $updated_row = $this->db->update($query);
                    if ($updated_row) {
                        $msg = "<span class='success'>Product Updated Successfully.</span> ";
                        return $msg;
                    } else {
                        $msg = "<span class='error'>Product Not Updated .</span> ";
                        return $msg;
                    }
                }

            } else {
                $query = "UPDATE products
              SET 
              name 	= '$productName',
              cate_id 		= '$catId',
              description 	= '$description',
              price 		= '$price',
              type 			= '$type'
              WHERE id = '$id' ";


                $updated_row = $this->db->update($query);
                if ($updated_row) {
                    $msg = "<span class='success'>Product Updated Successfully.</span> ";
                    return $msg;
                } else {
                    $msg = "<span class='error'>Product Not Updated .</span> ";
                    return $msg;
                }

            }
        }

    }

    public function proList()
    {
        $query = "Select * from products";
        $result = $this->db->select($query);
        return $result;
    }
    public function getproid($id)
    {
        $query = "Select * from products where id='$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function delproduct($id)
    {
        $query = "delete from products where id='$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $loginmsg = "delete product successfully!! ";
            return $loginmsg;

        } else {
            $loginmsg = "delete failed!! ";
            return $loginmsg;
        }
    }
    public function getNewProduct()
    {
        $query = "SELECT * FROM products ORDER BY id DESC LIMIT 4 ";
        $result = $this->db->select($query);
        return $result;
    }
    public function getFeatureProduct()
    {
        $query = "SELECT * FROM products where type = 1 ORDER BY id DESC ";
        $result = $this->db->select($query);
        return $result;
    }
    public function getSingleProduct($id)
    {
        $query = "SELECT products.*, categories.name as catName, categories.description as catDes
         FROM products
         INNER JOIN categories
         ON products.cate_id = categories.id
         AND products.id = $id
         ORDER BY products.id DESC";
        $result = $this->db->select($query);
        return $result; // i return this result 
    }
    public function addToCart($quantity, $id)
    {
        $quantity = $this->fm->validation($quantity); // add Format Class validation 
        $quantity = mysqli_real_escape_string($this->db->link, $quantity); // for $quantity filed 
        $productId = mysqli_real_escape_string($this->db->link, $id); // for $id filed 
        $sId = session_id(); // Create session id which will save your data as your browser id. 

        $squery = "SELECT * FROM products WHERE id = '$productId'";
        $result = $this->db->select($squery)->fetch_assoc();

        $productName = $result['name'];
        $price = $result['price'];
        $image = $result['image'];

        $query = "INSERT INTO cart(pro_id, pro_name, price, quantity, image) 
              VALUES ('$sId','$productId','$productName','$price','$quantity','$image')";

        $inserted_row = $this->db->insert($query);
        if ($inserted_row) {
            header("Location:cart.php");
        } else {
            header("Location:404.php");
        }
    }
}
?>