<?php
session_start();
setcookie("email","", time()-(3600*24*2));
setcookie("password","",time()-(3600*24*2));
session_destroy();
header("Location: loginAdmin.php");
?>