<?php include 'inc/header.php';?>
<?php include 'inc/left_sidebar.php';?>
<?php include_once '../classes/category.php';?>
<?php include_once '../classes/product.php';?>

<?php 
    if (!isset($_GET['proid'])  || $_GET['proid'] == NULL ) {
        echo "<script>window.location = 'productlist.php';  </script>";
     }else {
       $id = $_GET['proid'];
   
     }
   
      $pro =  new Product();
       if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']) ) {
                 
           $updateProduct = $pro->editproduct($_POST, $_FILES, $id);
       }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2> Edit Product</h2>
        <div class="block">               
         <form action="" method="post" enctype="multipart/form-data">
             <?php
               $pro_inf= $pro->getproid($id);
               if($pro_inf){
                while($result= $pro_inf->fetch_assoc()){              
                ?>
            <table class="form">
              
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result['name']?>" name="productName" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="catId">
                            <option>Select Category</option>
                            <?php 
                            $cat = new Category();
                            $cat_value = $cat->cateList();
                            if($cat_value){
                                while($results = $cat_value->fetch_assoc()){    
                            ?>

                            <option 
                            <?php 
                            if($result['cate_id']==$results['id']){
                                echo 'selected';
                            }
                            ?>
                            value="<?php echo $results['id']?>"><?php echo $results['name']?></option>
                            <?php  }
                            }?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="description"><?php echo $result['description']?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" value="<?php echo $result['price']?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img src="<?php echo $result['image'];?>" width="30%">
                        <input type="file" name="image" value="<?php echo $result['image']?>" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type" value="<?php echo $result['type']?>" >
                            <option>Select Type</option>
                            <?php
                            if ($result['type']==1){          
                             ?>
                            <option selected value="1">Featured</option>
                            <option value="2">Non-Featured</option>
                            <?php } else{?>
                                <option value="1">Featured</option>
                            <option selected value="2">Non-Featured</option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
                
            </table>
            </form>
            <?php 
                 }
                }
                ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


