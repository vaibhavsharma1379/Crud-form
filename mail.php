<?php
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';
// Load Composer's autoloader
// require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
// require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
function sendMail($email)
{
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'vaibhavsrh81@gmail.com';                     //SMTP username
        $mail->Password   = 'teisnyxfxcfsrchg';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('vaibhavsrh81@gmail.com', 'Mailer');
        $mail->addAddress($email);     //Add a recipient  //Name is optional
        $mail->addReplyTo($email, 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $otp=rand(1001,9999);
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'varification OTP';
        $mail->Body    = 'varifiacation OTP FOR YOUR Account is:' . $otp ;
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        return $otp;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
function sendResetLink($email)
{
    $mail = new PHPMailer(true);
    $otp=rand(1001,9999);
    $OTP=md5($otp);
    global $connPDO;
    $query=$connPDO->prepare('UPDATE admins SET token="'.$OTP.'" WHERE email="' . $email . '"');
    $query->execute();
    $row = $query->rowCount();
   if( $row > 0) {
    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'vaibhavsrh81@gmail.com';                     //SMTP username
        $mail->Password   = 'teisnyxfxcfsrchg';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('vaibhavsrh81@gmail.com', 'Mailer');
        $mail->addAddress($email);     //Add a recipient  //Name is optional
        $mail->addReplyTo($email, 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
       
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Reset Link';
        $mail->Body   = <<<END

        Link for Reseting Your Acoount Password  <a href="http://localhost/crudform/resetForgetPassword.php?token=$OTP">Click Here</a> to reset your password
        to reset your password.

        END;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
       echo '<script>alert("Mail Sent Succesfully")</script>';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
   }
   else{
    echo '<script>alert("Error in updating Token")</script>';
   }
}