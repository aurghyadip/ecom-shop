<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #b7ffc1;">
  <a class="navbar-brand" href="index.php">Aurghyadip's Shop</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
      </li>
    <?php if(!isset($_SESSION["email"])): ?>
      <li class="nav-item">
        <a href="login.php" class="nav-link">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="register.php">Register</a>
      </li>
    <?php endif; ?>
      <li class="nav-item">
        <a class="nav-link" href="cart.php">Cart</a>
      </li>
    </ul>
    <?php if(isset($_SESSION["email"])): ?>
      <span class="navbar-text"> Hello 
        <?php
          $email = $_SESSION["email"];
          $fresult = mysqli_query($con, "SELECT * FROM user_details WHERE email = '$email';");
          $frow = mysqli_fetch_assoc($fresult);
          echo $frow["firstname"];
        ?>
      </span>&nbsp;&nbsp;
      <a class="btn btn-secondary my-2 my-sm-0 text-white" href="logout.php">Logout</a>
   <?php endif; ?>
  </div>
</nav>