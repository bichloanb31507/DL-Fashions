<?php include 'inc/header.php';
include 'inc/left_sidebar.php';
include_once '../classes/category.php';
?>
<?php
$list = new Category();
if (isset($_GET['cateid'])) {
    $id = $_GET['cateid'];
    $delcate = $list->delcategory($id);
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <h2>Category List</h2>
    <table class="table table-striped">
        <thead>
            <tr class="bg-dark">
                <th>STT</th>
                <th>Name</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $list_cate = $list->cateList();
            if ($list_cate) {
                $i = 0;
                while ($result = $list_cate->fetch_assoc()) {
                    $i++;
                    ?>
                    <tr>
                        <th>
                            <?php echo $i; ?>
                        </th>
                        <th>
                            <?php echo $result['name']; ?>
                        </th>
                        <th>
                            <?php echo $result['description']; ?>
                        </th>

                        <td><a href="editcategory.php?cateid=<?php echo $result['id'] ?>">Edit</a> || <a
                                onclick="return confirm('are you want to delect this category?')"
                                href="?cateid=<?php echo $result['id'] ?>">Delete</a></td>
                    </tr>
                <?php }
            } ?>
        </tbody>
    </table>
</div>
<!-- /.container-fluid -->

<?php include 'inc/footer.php'; ?>