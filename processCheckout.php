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

require_once 'system/DB_CONFIG.php';

if(isset($_POST) && !empty($_POST))
{
	$address = $_POST["address"];
	$phone = $_POST["phone"];
	$payment = $_POST["payment"];
	$amount = $_SESSION["cart"]->total();;

	$query = "INSERT INTO order_details (order_address, order_payment, order_amount, order_phone) VALUES ('$address', '$payment', '$amount', '$phone');";
	if(mysqli_query($con, $query))
	{
		$order_id = mysqli_insert_id($con);
		foreach ($_SESSION["cart"]->contents(true) as $item) 
		{
			$id = $item['id'];
			$sql = "INSERT INTO order_products (order_id, product_id) VALUES ('$order_id', '$id');";
			mysqli_query($con, $sql);
		}
		$_SESSION["cart"] = NULL;
		header("location:index.php");
	}
}

include_once 'header.php';

include_once 'navbar.php';
?>

<div class="container">
    <div class="row p-3">
        <div class="col-sm">
            <div class="card text-center">
                <div class="card-header">Featured</div>
                <div class="card-body">
                    <h4 class="card-title">Order Successful</h4>
                    <p class="card-text">You have successfully placed an order. Close this window or return to the home page</p>
                    <a href="index.php" class="btn btn-primary">Return to Home</a>
                </div>
                <div class="card-footer text-muted">Thank You</div>
            </div>
        </div>
    </div>
</div>
</body>
</html>