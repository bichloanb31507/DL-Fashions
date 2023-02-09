<?php ob_start(); ?>
<?php include_once 'inc/header.php'; ?> 
<?php 
  $login =  Session::get("cuslogin");
  if ($login == false) {
  	header("Location:login.php");
  }
  ?>

<h2> success</h2>
<p> Thanks for Purchase. Receive your order Successfully. We will contact you ASAP with delivery details. Here is your order details :<a href="order.php"> Visit Here </a> </p>
<?php include_once 'inc/footer.php'; ?> 