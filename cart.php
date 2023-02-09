<?php ob_start(); ?>
<?php include_once 'inc/header.php'; ?>
<?php
 if (isset($_GET['delpro'])) {
 	 $delId = $_GET['delpro'];
 	 $delProduct = $ca->delProductByCart($delId);
 }
?>



<?php 
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cartId = $_POST['cartId'];
        $quantity = $_POST['quantity'];
        
        $updateCart = $ca->updateCartQuantity($cartId, $quantity);
        if ($quantity <= 0) {
        	$delProduct = $ca->delProductByCart($cartId);
        }
    }   

?>
<?php
if (!isset($_GET['id'])) {
	echo "<meta http-equiv='refresh' content='0;URL=?id=live'/> ";
}
?>
        
        <!-- Breadcrumb Start -->
        <div class="breadcrumb-wrap">
            <div class="container-fluid">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Products</a></li>
                    <li class="breadcrumb-item active">Cart</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb End -->
        
        <!-- Cart Start -->
        <div class="cart-page">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="cart-page-inner">
                            <div class="table-responsive">
                            <?php
                            if (isset($updateCart)) {
                                echo $updateCart;
                            }
                            if (isset($delProduct)) {
                                echo $delProduct;
                            }

                                ?>
                            <?php 
 
                            $getData = $ca->checkCartTable();
                            if ($getData) {
                            ?>
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody class="align-middle">
                                    <?php
                                    $getPro = $ca->getCartProduct();  // Create this method in our Cart.php Class page. 
                                    if ($getPro) {
                                        $i = 0;
                                        $sum = 0;
                                        $qty =0;
                                        while ($result = $getPro->fetch_assoc()) {
                                        $i++;
                                        
                                            ?>
                                        <tr>
                                        <td><?php echo $i;  ?></td>
                                            <td>
                                                <div class="img">
                                                    <a href="#"><img src="admin/<?php echo $result['image']; ?>" alt=""/></a>
                                                    <p><?php echo $result['pro_name'];  ?></p>
                                                </div>
                                            </td>
                                            <td>$ <?php echo $result['price'];  ?></td>
                                            <td>
                                                <div class="qty">
                                                <form action="" method="post"> 
                                                   <input type="hidden" name="cartId" value="<?php echo $result['id'];  ?>"/>
                                                    <button class="btn-minus"><i class="fa fa-minus"></i></button>
                                                    <input type="number" name="quantity" value="<?php echo $result['quantity'];  ?>">
                                                    <button class="btn-plus"><i class="fa fa-plus"></i></button>
                                                    <input type="submit" name="submit" value="Update"/>
                                                    </form>
                                                </div>
                                            </td>
                                            <td><?php 
                                            $total = $result['price'] * $result['quantity'];
                                            echo $total; 
                                        ?>	</td>
                                            <td><a onclick="return confirm('Are you sure to Delete');" href="?delpro=<?php echo $result['id']; ?>"><i class="fa fa-trash"></i></a></td>
                                        </tr>
                                        <?php 
                                        $qty = $qty +  $result['quantity'];
                                        $sum = $sum + $total;
                                        Session::set("qty", $qty);
                                        Session::set("sum", $sum);
                                        ?>
			                            <?php } }   ?> 
                                           
                                    </tbody>
                                </table>
                                <?php } else { 
   header("Location:index.php"); // redirect to index.php page when its empty 
    // echo "Cart Empty";  
                    }  ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="cart-page-inner">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="coupon">
                                        <input type="text" placeholder="Coupon Code">
                                        <button>Apply Code</button>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="cart-summary">
                                        <div class="cart-content">
                                            <h1>Cart Summary</h1>
                                            <p>Sub Total<span>$ <?php echo $sum;  ?></span></p>
                                            <p>Shipping Cost<span>10%</span></p>
                                            <h2>Grand Total<span>$<?php 
                                            $vat = $sum * 0.1;
                                            $gtotal = $sum + $vat;
                                            echo $gtotal;
                                            ?></span></h2>
                                        </div>
                                        <div class="cart-btn">
                                            <button>Update Cart</button>
                                            <button> <a href="checkout.php">Checkout</a></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cart End -->
        
        <!-- Footer Start -->
        <div class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h2>Get in Touch</h2>
                            <div class="contact-info">
                                <p><i class="fa fa-map-marker"></i>123 E Store, Los Angeles, USA</p>
                                <p><i class="fa fa-envelope"></i>email@example.com</p>
                                <p><i class="fa fa-phone"></i>+123-456-7890</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h2>Follow Us</h2>
                            <div class="contact-info">
                                <div class="social">
                                    <a href=""><i class="fab fa-twitter"></i></a>
                                    <a href=""><i class="fab fa-facebook-f"></i></a>
                                    <a href=""><i class="fab fa-linkedin-in"></i></a>
                                    <a href=""><i class="fab fa-instagram"></i></a>
                                    <a href=""><i class="fab fa-youtube"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h2>Company Info</h2>
                            <ul>
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Terms & Condition</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h2>Purchase Info</h2>
                            <ul>
                                <li><a href="#">Pyament Policy</a></li>
                                <li><a href="#">Shipping Policy</a></li>
                                <li><a href="#">Return Policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="row payment align-items-center">
                    <div class="col-md-6">
                        <div class="payment-method">
                            <h2>We Accept:</h2>
                            <img src="img/payment-method.png" alt="Payment Method" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="payment-security">
                            <h2>Secured By:</h2>
                            <img src="img/godaddy.svg" alt="Payment Security" />
                            <img src="img/norton.svg" alt="Payment Security" />
                            <img src="img/ssl.svg" alt="Payment Security" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->
        
        <!-- Footer Bottom Start -->
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 copyright">
                        <p>Copyright &copy; <a href="https://htmlcodex.com">HTML Codex</a>. All Rights Reserved</p>
                    </div>

                    <div class="col-md-6 template-by">
                        <p>Template By <a href="https://htmlcodex.com">HTML Codex</a></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Bottom End -->       
        
        <!-- Back to Top -->
        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
        
        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/slick/slick.min.js"></script>
        
        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>
</html>
