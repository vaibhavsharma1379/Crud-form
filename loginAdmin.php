<?php


require_once "./function/function.php";
require_once "./config/config.php";
// require 'vendor/autoload.php';
session_start();
if (isset($_POST['loginAdmin'])) {
  loginAdmin();
}
if (isset($_POST['sendmail'])) {
  print_r('clicked');
  send_mail();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Latest compiled JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
</head>

<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">Register</div>
          <div class="card-body">
            <form method="post" id="adminLoginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
              <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
              </div>
              <button type="submit" class="btn btn-primary" name="loginAdmin" value="loginAdmin">Login</button>
              <div><input type="checkbox" name="remember" id="remember"/>
                <label for="remember-me" class="form-check-label">Remember me</label>
            </div>
            
            </form>
          </div>
          <div class="card-footer">
            <p>Don't have an account? <a href="registerAdmin.php">Register here</a></p>
            <p ><a href="forgetPasswordByMail.php">forgot password?</a></p>
            <!-- <select>
              <option >forget password?</a></option>
              <option value="1"><a href="forgetPassword.php">forgot password by Otp?</a></option>
              <option value="2"><a href="forgetPassword.php">forgot password by Mail?</a></option>
            </select> -->
          </div>
          
        </div>
      </div>

    </div>
  </div>
</body>


</html>