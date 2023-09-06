<?php
require_once 'mail.php';
require_once "./function/function.php";
require_once "./config/config.php";
session_start();
if (isset($_POST['sentOTPBtn'])) {
    extract($_POST);
    $otp = sendMail($email);
    $_SESSION['otp'] = $otp;
    $_SESSION['email'] = $email;
    $emailSent = "sentOtp";
}
if (isset($_POST['verfyOTPBtn'])) {
    $emailSent = "otpVerify";
}

if (isset($_POST['rstPasswordBtn'])) {
    // $emailSent="otpVerify";
    updateAdminPasswordByOTP();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>forgetPassword</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container w-25 mt-4 border p-4">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="mb-3 ">
                <label for="exampleInputEmail1" class="form-label" name="recoveryEmail">Email address</label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" value="<?php if (isset($emailSent)) {
                                                                                                                            echo $_SESSION['email'];
                                                                                                                        } ?>">
                <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
            </div>
            <?php
            if (isset($emailSent) && $emailSent == "sentOtp") {
                echo '<div class="mb-3">
                <label for="OTP" class="form-label">OTP</label>
                <input type="text" name="OTP" class="form-control" id="OTP" aria-describedby="emailHelp">
            </div>';
            }

            ?>
            <?php
            if (isset($_POST['verfyOTPBtn']) && $emailSent == "otpVerify" &&  isset($_SESSION['otp']) && $_POST['OTP'] == $_SESSION['otp']) {
                echo '<div class="mb-3">
                <label for="password" class="form-label">Enter New Password</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input type="confirmPassword" name="confirmPassword" class="form-control" id="confirmPassword">
            </div>';
                // $emailSent=' ';
            } else if (isset($_POST['verfyOTPBtn']) && $emailSent == "otpVerify"  &&  isset($_SESSION['otp']) && $_POST['OTP'] != $_SESSION['otp']) {
                // $emailSent=' ';
                echo '<p class="text-danger">You Entered Incorrect OTP</p>';
            }
            ?>
            <div class="d-flex flex-column align-items-center">
                <button type="submit" class="btn btn-primary" name=<?php if (isset($emailSent) && $emailSent == "sentOtp") {
                                                                        echo "verfyOTPBtn";
                                                                    } elseif (isset($emailSent) && $emailSent == "otpVerify") {
                                                                        echo "rstPasswordBtn";
                                                                    } else {
                                                                        echo "sentOTPBtn";
                                                                    } ?>><?php if (isset($emailSent) && $emailSent == "sentOtp") {
                                                                                echo "verfy OTP";
                                                                            } elseif (isset($emailSent) && $emailSent == "otpVerify") {
                                                                                echo "Reset Password";
                                                                            } else {
                                                                                echo "sent OTP";
                                                                            } ?></button>
            </div>
        </form>
    </div>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>

</html>