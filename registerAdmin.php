<?php
require_once "./function/function.php";
require_once "./config/config.php";
if (isset($_POST['registerAdminbtn'])) {
  // print_r("succesfull");
  ragisterAdmin();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register User</title>
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
            <form method="post" id="registerAdmin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
              <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
              </div>
              <div class="form-group">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password" id="confirm-password" placeholder="Confirm Password" required>
              </div>
              <div class="form-group">
                <label for="mobile">Mobile Number</label>
                <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter mobile Number" required>
              </div>
              <div class="form-group">
                <div class="col-6">
                  <label for="status">Status:</label><br>
                  <div class="d-flex justify-content-start">
                    <div>
                      <input class="form-check-input" type="radio" id="active" name="status" value="active" checked>
                      <label class="form-check-label" for="active">Active</label><br>
                    </div>
                    <div>
                      <input class="form-check-input" type="radio" id="inactive" name="status" value="inactive">
                      <label class="form-check-label" for="inactive">InActive</label><br>
                    </div>

                  </div>
                </div>




              </div>
              <button type="submit" class="btn btn-primary" name="registerAdminbtn" value="registerAdmin">Register</button>
            </form>
          </div>
          <div class="card-footer">
            <p>Don't have an account? <a href="loginAdmin.php">Login here</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<!-- <script>
    $(document).ready(function(){
      // alert("ready");
      $("#registerAdmin").on("submit",function(e){
        e.preventDefault();
        // alert("submitted");
        var form=$(this);
        // alert(form.serialize);
        $.ajax({
        url:"./ajax/ajax.php",
        type:'POST',
        data:form.serialize(),
        success:function(data){
          
        }
        });
      })
    })
</script> -->

</html>