<?php
session_start();

$servername = "Register";

if(isset($_SESSION["email"]))
{
    header("location:index.php");
}
require_once 'system/DB_CONFIG.php';

if(isset($_POST) && !empty($_POST))
{
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];


    if(empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($confirm_password))
    {
        $output = array(
            "error" => true,
            "status" => "fields must not be empty"
        );
    }
    else
    {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $query = "SELECT * from user_details WHERE email = '$email'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
        if($row == NULL)
        {
            $query = "INSERT INTO user_details (firstname, lastname, email, password) VALUES ('$firstname', '$lastname', '$email','$password')";
            if(mysqli_query($con, $query))
            {
                $output = array (
                    "error" => false,
                    "status" => "Registered new user, please login."
                );
            }
            else
            {
                $output = array(
                    "error" => true,
                    "status" => "Not registered! Unknown error"
                );
            }
        }
        else
        {
            $output = array(
                "error" => true,
                "status" => "email already exists"
            );
        }  
    }
}

include_once 'header.php';
include_once 'navbar.php';

?>
<div class="container">
    <div class="row p-3">
        <div class="card col-sm-4 offset-sm-4">
            <h4 class="pb-3 pt-3">Register</h4>
            <form id="register" method="post">
                 <div class="form-group">
                    <label for="firstname">Firstname</label>
                    <input type="text" class="form-control" name="firstname">
                </div>
                <div class="form-group">
                    <label for="lastname">Lastname</label>
                    <input type="text" class="form-control" name="lastname">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" class="form-control" name="confirm_password">
                </div>
                <div class="form-group">
                    <input type="submit" value="Register" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    <?php if($output["error"]): ?>
    alert("<?php echo $output["status"]; ?>");
    <?php else: ?>
    alert("<?php echo $output["status"]; ?>");
    window.location = "login.php";
    <?php endif; ?>
</script>
</body>
</html>