<?php include 'inc/header.php';
include 'inc/left_sidebar.php';
include_once '../classes/product.php';
?>
<?php 
$list = new Product();
if(isset($_GET['proid'])){
	$id = $_GET['proid'];
	$deletepro= $list->delproduct($id);

}
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <h2>Product List</h2>
    <table class="table table-striped">
        <thead>
        <tr>
					<th>Post Title</th>
					<th>Description</th>
					<th>Category</th>
					<th>Image</th>
					<th>Action</th>
				</tr>
        </thead>
        <tbody>
        <?php 
				$list_product = $list->proList();
				if($list_product){
					while($result = $list_product->fetch_assoc()){

					
				?>
				<tr class="odd gradeX">
					<td><?php echo $result['name'] ?></td>
					<td><?php echo $result['price'] ?></td>
					<td><?php echo $result['cate_id'] ?></td>
					<td class="center"> <?php echo $result['description'] ?></td>
					<td class="center"> <img src="<?php echo $result['image'];?>" width="100px"></td>
					<td class="center"> <?php if ($result['type'] == 1) {
		        echo "Featured";
			 }else {
			     echo "General";
				 }  ?></td>
					<td><a href="editproduct.php?proid=<?php echo $result['id'];?>">Edit</a> || <a onclick="return confirm('are you want to delate this product?')" 
							href="?proid=<?php echo $result['id']?>">Delete</a></td>
				</tr>
				<?php 
				}
			}
				?>
        </tbody>
    </table>
</div>
<!-- /.container-fluid -->

<?php include 'inc/footer.php'; ?>