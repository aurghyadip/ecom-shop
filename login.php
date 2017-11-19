<?php
session_start();

$servername = "Login";

require_once 'system/DB_CONFIG.php';

if(isset($_SESSION["email"]))
{
    header("location:index.php");
}

if(isset($_POST) && !empty($_POST))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $output = array();

    if(empty($email) || empty($password))
    {
        $output = array(
            "error" => true,
            "status" => "fields must not be empty"
        );
    }
    else
    {
        $query = "SELECT email, password from user_details where email = '$email';";
        $result = mysqli_query($con, $query);

        $row = mysqli_fetch_assoc($result);
        if(!empty($row))
        {
            $dEmail = $row['email'];
            $dPass = $row['password'];
            if(password_verify($password, $dPass))
            {
                $_SESSION['email'] = $dEmail;
                header("location:index.php");
            }
            else
            {
                $output = array (
                    "error" => true,
                    "status" => "password does not match"
                );
            }
        }
        else
        {
            $output = array (
                "error" => true,
                "status" => "email not in DB, please register"
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
            <h4 class="pb-3 pt-3">Login</h4>
            <form id="login" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="form-group">
                    <input type="submit" value="submit" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
