<?php
$servername = "Cart";

require 'vendor/autoload.php';
session_start();
use Moltin\Cart\Cart;
use Moltin\Cart\Storage\Session;
use Moltin\Cart\Identifier\Cookie;

$_SESSION["cart"] = new Cart(new Session, new Cookie);

require_once 'system/DB_CONFIG.php';

if(isset($_GET) && !empty($_GET["item_id"]))
{
	$query = "SELECT * FROM product_details WHERE product_id = ".$_GET["item_id"].";";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_array($result);
	$_SESSION["cart"]->insert(array(
		'id' => $_GET["item_id"],
		'name' => $row["product_name"],
		'price' => $row["product_price"],
		'baseprice' => $row["product_price"],
		'quantity' => 1,
		'rent' => 3
	));
}

include_once 'header.php';

include_once 'navbar.php'; 

?>


<div class="container">
	<div class="row p-3">
		<?php if(isset($_SESSION["cart"]) && !empty($_SESSION["cart"]->contents(true))): ?>
			<div class="list-group col-sm-9">
				<?php foreach($_SESSION["cart"]->contents(true) as $key => $item): ?>
				<div class="card">
					<div class="card-body">
						<h4 class="card-title"><?php echo $item["name"]; ?></h4>
						<a class="text-danger" href="processCart.php?delete=<?php echo $key; ?>"><small>Remove</small></a><br>
						<p>
							<a class="btn btn-sm btn-danger" href="processCart.php?id=<?php echo $key; ?>&quantity=increase">+</a> 
							<?php echo $item["quantity"]; ?> 
							<?php if($item["quantity"] > 1): ?>
								<a class="btn btn-sm btn-danger" href="processCart.php?id=<?php echo $key; ?>&quantity=decrease">-</a>
							<?php endif; ?>
						</p>
						<h5>Price = <span class="text-success">Rs. <?php echo $item["price"]; ?></span></h5>
					</div>
				</div>
			<?php endforeach; ?>
			</div>
			<div class="col-sm-3">
				<div class="text-white bg-dark mb-3 text-center">
					<div class="card-header">Total Amount</div>
						<div class="card-body">
							<h2><span id="priceSpan"><strong>Rs. <?php echo $_SESSION["cart"]->total(); ?></strong></span></h2><br>
							<?php if($_SESSION["cart"]->total() > 0): ?>
								<a href="checkout.php" class="btn btn-success btn-block">Checkout</a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
			
		<?php else: ?>
			<div class="col-sm-8 offset-sm-2">
				<div class="card text-center">
					<div class="card-body">
						<h3 class="card-title">Your Cart is Empty!!</h3>
						<p class="card-text">
							Your Shopping Cart lives to serve. Give it purpose--fill it with books, CDs, videos, DVDs, electronics, and more. Continue shopping on the website homepage. The price and availability of items at website are subject to change. The shopping cart is a temporary place to store a list of your items and reflects each item's most recent price.
						</p>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>
</body>
</html>