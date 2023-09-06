<?php
require_once 'mail.php';
require_once "./function/function.php";
require_once "./config/config.php";
if (isset($_POST["resetBtn"])) {
    extract($_POST);
    sendResetLink($email);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password By Mail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container w-25 mt-4 border p-4">
        <h3>Forgot Password</h3>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" >
            <div class="mb-3 ">
                <label for="exampleInputEmail1" class="form-label" name="recoveryEmail">Email address</label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter Your Mail">
           
            </div>
            <div class="d-flex flex-column align-items-center">
                <button type="submit" class="btn btn-primary" name="resetBtn">Send Reset Link</button>
            </div>            
        </form>
        <hr>
        <div class="d-flex justify-content-between">
            <div>
                <P><a href="loginAdmin.php">Login</a></P>
            </div>
            <div>
                <P><a href="registerAdmin.php">Register</a></P>
            </div>
        </div>
    </div>
    
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>
</html>