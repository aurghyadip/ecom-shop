<?php

session_start();

$servername = "Home";

require_once 'system/DB_CONFIG.php';

$result = mysqli_query($con, "SELECT * FROM product_details");

include_once 'header.php';

include_once 'navbar.php';

?>


<div class="container-fluid">
	<div class="row p-3">
		<div class="card-columns">
		<?php while($row = mysqli_fetch_assoc($result)): ?>
			<div class="card mb-3">
				<img class="card-img-top pl-3 pr-3 pt-3" src="<?php echo $row["product_image"]; ?>" alt="Card image cap">
			    <div class="card-body">
				    <h4 class="card-title"><?php echo $row["product_name"]; ?></h4>
				    <p class="card-text"><?php echo $row["product_details"]; ?></p>
			    </div>
			    <div class="card-footer text-center">
			    	<a class="btn btn-success btn-block" href="cart.php?item_id=<?php echo $row["product_id"]; ?>">Buy for <strong>Rs. <?php echo $row["product_price"]; ?>/-</strong></a>
			    </div>
			</div>
		<?php endwhile; ?>
		</div>
	</div>
</div>
</body>
</html>
