<?php include 'inc/header.php'; ?>
<?php include 'inc/left_sidebar.php'; ?>
<?php include '../classes/category.php'; ?>
<?php
$al = new Category();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cateName = $_POST['cateName'];
    $cateDescription = $_POST['cateDescription'];
    $insertcate = $al->addcategory($cateName, $cateDescription);
}
?>
<div class="container-fluid">
    <h2>Category Add</h2>
    <?php
    if (isset($insertcate)) {
        echo $insertcate;
    }
    ?>
    <form action="addcategory.php" method="post">
        <table class="form">
            <tr>
                <td>
                    <input type="text" name="cateName" placeholder="Enter Category Name..." class="medium" />
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="cateDescription" placeholder="Enter Category Description..."
                        class="medium" />
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="submit" Value="Save" />
                </td>
            </tr>
        </table>
    </form>
</div>
<?php include 'inc/footer.php'; ?>