<?php

session_start();

$servername = "Checkout";

if(!isset($_SESSION["email"]))
{
	header("location:login.php");
}

require 'vendor/autoload.php';
use Moltin\Cart\Cart;
use Moltin\Cart\Storage\Session;
use Moltin\Cart\Identifier\Cookie;

$_SESSION["cart"] = new Cart(new Session, new Cookie);

include_once 'header.php';

include_once 'navbar.php';

?>


<div class="container">
	<div class="row p-3">
		<div class="col-sm card">
			<div class="row align-items-center">
				<p class="mx-auto">
					<span class="display-4">Total Amount</span><br>
					<span class="display-2 text-success">Rs. <?php echo $_SESSION["cart"]->total(); ?></span>
				</p>
			</div>
		</div>
		<div class="col-sm card">
			<h5 class="p-3">Adress of Shipping</h5>
			<form method="post" action="processCheckout.php">
				<div class="form-group pl-3 pr-3">
					<label for="address">Address</label>
					<textarea name="address" id="" cols="30" rows="5" class="form-control"></textarea>
				</div>
				<div class="form-group pr-3 pl-3">
					<label for="phone">Phone No</label>
					<input type="text" name="phone" class="form-control">
				</div>
				<h6 class="display-6 pl-3 pr-3">Payement Method</h6>
				<div class="form-group pr-3 pl-3">
					<label for="payment" class="pl-3 pr-3">
					<input type="radio" name="payment" class="form-check-input" value="COD">COD</label>
				</div>
				<div class="form-group pr-3 pl-3">
					<input type="submit" value="Submit" class="btn btn-primary">
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>