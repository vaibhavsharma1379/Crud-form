<?php
if(isset($_GET["token"])){
    $token = $_GET["token"];
    // $_SESSION["token"] = $token;
}
require_once 'mail.php';
require_once "./function/function.php";
require_once "./config/config.php";
//  print_r($token);
// $notMatched="";
session_start();

if(isset($_POST["resetPassword"])) {
    if($_POST["password"]== $_POST["confirmPassword"]) {
        updateAdminPasswordByMail($token);
    }
    else{
        echo "<script>alert('password not matched')</script>";
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Forgot Password</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5 border p-4" style="max-width: 600px  ;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label" >Confirm Password</label>
                        <span style="color: red">*</span>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                    </div>
                    <button type="submit" class="btn btn-primary" id="reset_forgot_pass" name="resetPassword">Reset Password</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>