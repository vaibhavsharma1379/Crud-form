<?php

require_once "../function/function.php";
require_once "../config/config.php";
$id=$_GET["id"];
$empData=getEmpDetailsByID("ragistration","emp_id",$id);
// print_r($empData);
print_r($empData);
// echo $empData;

?>
