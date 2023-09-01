<?php
session_start();
session_destroy();
setcookie("email","", time() -3600,"/");
setcookie("logged_in","", time() -3600,"/");
header("Location: loginAdmin.php");
?>