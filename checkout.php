<?php ob_start(); ?>
<?php include_once 'inc/header.php'; ?> 
<?php 
  $login =  Session::get("cuslogin");
  if ($login == false) {
  	header("Location:login.php");
  }

  ?>
<?php
   if (isset($_GET['orderid']) && $_GET['orderid'] == 'order' ) {
   $cmrId =  Session::get("cmrId");
   $insertOrder = $ca->orderProduct($cmrId); // create this method in our Cart.php Class page 
   $delDate = $ca->delCustomerCart();
  header("Location:success.php");
   }
 ?> 

        <!-- Breadcrumb Start -->
        <div class="breadcrumb-wrap">
            <div class="container-fluid">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Products</a></li>
                    <li class="breadcrumb-item active">Checkout</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb End -->
        
        <!-- Checkout Start -->
        <div class="checkout">
            <div class="container-fluid"> 
                <div class="row">
                    <div class="col-lg-8">
                    <?php 
                        $id = Session::get('cmrId');
                        $getdata = $us->getCustomerData($id);
                        if ($getdata) {
                            while ($result = $getdata->fetch_assoc()) {
                        ?>
                        <div class="checkout-inner">
                            <div class="billing-address">
                                <h2>Billing Address</h2>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>First Name</label>
                                        <input class="form-control" type="text" placeholder="First Name" value="<?php echo $result['firstname']; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Last Name"</label>
                                        <input class="form-control" type="text" placeholder="Last Name" value="<?php echo $result['lastname']; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label>E-mail</label>
                                        <input class="form-control" type="text" placeholder="E-mail" value="<?php echo $result['email']; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Mobile No</label>
                                        <input class="form-control" type="text" placeholder="Mobile No" value="<?php echo $result['phone']; ?>">
                                    </div>
                                    <div class="col-md-12">
                                        <label>Address</label>
                                        <input class="form-control" type="text" placeholder="Address" value="<?php echo $result['address']; ?>">
                                    </div>
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="newaccount">
                                            <label class="custom-control-label" for="newaccount">Create an account</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="shipto">
                                            <label class="custom-control-label" for="shipto">Ship to different address</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="shipping-address">
                                <h2>Shipping Address</h2>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>First Name</label>
                                        <input class="form-control" type="text" placeholder="First Name">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Last Name"</label>
                                        <input class="form-control" type="text" placeholder="Last Name">
                                    </div>
                                    <div class="col-md-6">
                                        <label>E-mail</label>
                                        <input class="form-control" type="text" placeholder="E-mail">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Mobile No</label>
                                        <input class="form-control" type="text" placeholder="Mobile No">
                                    </div>
                                    <div class="col-md-12">
                                        <label>Address</label>
                                        <input class="form-control" type="text" placeholder="Address">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Country</label>
                                        <select class="custom-select">
                                            <option selected>United States</option>
                                            <option>Afghanistan</option>
                                            <option>Albania</option>
                                            <option>Algeria</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>City</label>
                                        <input class="form-control" type="text" placeholder="City">
                                    </div>
                                    <div class="col-md-6">
                                        <label>State</label>
                                        <input class="form-control" type="text" placeholder="State">
                                    </div>
                                    <div class="col-md-6">
                                        <label>ZIP Code</label>
                                        <input class="form-control" type="text" placeholder="ZIP Code">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php   } }  ?>  
                        <div class="cart-page-inner">
                            <div class="table-responsive">
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
                                                    <a href="#"><img src="admin/<?php echo $result['image']; ?>" alt="" width="30%"/></a>
                                                    <p><?php echo $result['pro_name'];  ?></p>
                                                </div>
                                            </td>
                                            <td>$ <?php echo $result['price'];  ?></td>
                                            <td>
                                                
                                                
                                           <?php echo $result['quantity'];  ?>
                                                
                                            </td>
                                            <td><?php 
                                            $total = $result['price'] * $result['quantity'];
                                            echo $total; 
                                        ?>	</td>
                                            
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
   //header("Location:index.php");
    echo "Cart Empty";  
                    }  ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="checkout-inner">
                        <div class="checkout-payment">
                                <div class="payment-methods">
                                    <h1>Payment Methods</h1>
                                    <div class="payment-method">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="payment-1" name="payment">
                                            <label class="custom-control-label" for="payment-1">offline payment</label>
                                        </div>
                                        <div class="payment-content" id="payment-1-show">
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="payment-method">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="payment-2" name="payment">
                                            <label class="custom-control-label" for="payment-2">Online payment</label>
                                        </div>
                                        <div class="payment-content" id="payment-2-show">
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="payment-method">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="payment-3" name="payment">
                                            <label class="custom-control-label" for="payment-3">Check Payment</label>
                                        </div>
                                        <div class="payment-content" id="payment-3-show">
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                            </p>
                                        </div>
                                    </div>
                                    <div class="payment-method">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="payment-4" name="payment">
                                            <label class="custom-control-label" for="payment-4">Direct Bank Transfer</label>
                                        </div>
                                        <div class="payment-content" id="payment-4-show">
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                            </p>
                                        </div>
                                    </div>
                                    <div class="payment-method">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="payment-5" name="payment">
                                            <label class="custom-control-label" for="payment-5">Cash on Delivery</label>
                                        </div>
                                        <div class="payment-content" id="payment-5-show">
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="checkout-summary">
                                <h1>Cart Total</h1>
                                <p class="sub-total">Sub Total<span>$ <?php echo $sum;  ?></span></p>
                                <p class="ship-cost">Shipping Cost<span>10%</span></p>
                                <h2>Grand Total<span>$<?php 
                                            $vat = $sum * 0.1;
                                            $gtotal = $sum + $vat;
                                            echo $gtotal;
                                            ?></span></h2>
                                <div class="checkout-btn">
                                    <button><a href="?orderid=order"> Order </a></button>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Checkout End -->
        
        <?php include 'inc/footer.php'; ?>