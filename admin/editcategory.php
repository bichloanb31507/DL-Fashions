<?php include 'inc/header.php'; ?>
<?php include 'inc/left_sidebar.php'; ?>
<?php include '../classes/category.php'; ?>
<?php
$al = new Category();
if (!isset($_GET['cateid']) || $_GET['cateid'] == NULL) {
    header("Location:catlist.php");
} else {
    $id = $_GET['cateid'];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cateName = $_POST['cateName'];
    $cateDescription = $_POST['cateDescription'];
    $editcate = $al->editcategory($cateName, $cateDescription, $id);
}
?>
<div class="container-fluid">
    <h2>Category Edit</h2>
    <?php
    if (isset($editcate)) {
        echo $editcate;
    }
    ?>
    <?php
    $get_cate_inf = $al->getcateid($id);
    if ($get_cate_inf) {
        while ($result = $get_cate_inf->fetch_assoc()) {
            ?>
            <form action="" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <input type="text" value="<?php echo $result['name'] ?>" name="cateName"
                                placeholder="Enter Category Name..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" value="<?php echo $result['description'] ?>" name="cateDescription"
                                placeholder="Enter Category Description..." class="medium" />
                        </td>
                    </tr>
                    <tr>
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
<?php include 'inc/footer.php'; ?>