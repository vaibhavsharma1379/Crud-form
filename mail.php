<?php
ini_set('SMTP', 'smtp.gmail.com');
ini_set('smtp_port', '3306');
ini_set('sendmail_from', 'vaibhavsrh766@gmail.com');
// the message
$msg = "First line of text\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail("vaibhavsrh78@gmail.com","My subject",$msg);
?>