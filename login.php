<?php ob_start(); ?>
<?php include_once 'inc/header.php'; ?>   
<?php 
  $login =  Session::get("cuslogin");
  if ($login == true) {
  	header("Location:index.php");
  }
  ?>
<?php 
   
   if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register']) ) {
             
       $customerReg = $us->customerRegistration($_POST);
   }

?>


               <?php 
                 if (isset($customerReg)) {
                     echo $customerReg;
                 }

               ?>
        
        <!-- Breadcrumb Start -->
        <div class="breadcrumb-wrap">
            <div class="container-fluid">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Products</a></li>
                    <li class="breadcrumb-item active">Login & Register</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb End -->
        
        <!-- Login Start -->
        <div class="login">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">    
                        <div class="register-form">
                        <form action=" " method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>First Name</label>
                                    <input class="form-control" type="text" placeholder="First Name" name="firstname">
                                </div>
                                <div class="col-md-6">
                                    <label>Last Name"</label>
                                    <input class="form-control" type="text" placeholder="Last Name" name="lastname">
                                </div>
                                <div class="col-md-6">
                                    <label>E-mail</label>
                                    <input class="form-control" type="text" placeholder="E-mail" name="email">
                                </div>
                                <div class="col-md-6">
                                    <label>Mobile No</label>
                                    <input class="form-control" type="text" placeholder="Mobile No" name="phone">
                                </div>
                                <div class="col-md-12">
                                    <label>Address</label>
                                    <input class="form-control" type="text" placeholder="Address" name="address">
                                </div>
                                <div class="col-md-6">
                                    <label>Password</label>
                                    <input class="form-control" type="text" placeholder="Password" name="password">
                                </div>
                                <div class="col-md-6">
                                    <label>Retype Password</label>
                                    <input class="form-control" type="text" placeholder="Password" name ="re_password">
                                </div>
                                <div class="col-md-12">
                                    <button class="btn" type="register" name="register">Submit</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <?php 
     if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login']) ) {
          $customLogin = $us->customerLogin($_POST);
    }
?>
<?php 
   if (isset($customLogin)) {
	 echo $customLogin;
		 }
 ?>
                    <div class="col-lg-6">
                        <div class="login-form">
                            <form action=" " method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>E-mail</label>
                                        <input class="form-control" type="text" placeholder="E-mail" name="email">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Password</label>
                                        <input class="form-control" type="password" placeholder="Password" name="pass">
                                    </div>
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="newaccount">
                                            <label class="custom-control-label" for="newaccount">Keep me signed in</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn" name="login">Submit</button>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Login End -->
        
        <?php include 'inc/footer.php'; ?>