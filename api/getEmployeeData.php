<?php

require_once "../function/function.php";
require_once "../config/config.php";
$id=$_GET["id"];
$empData=getEmpDetailsByID("ragistration","emp_id",$id);
// print_r($empData);
//print_r($empData);
$empData=json_encode($empData);
print_r($empData);
// echo $empData;
// return($empData);
$aq=100;
echo $aq;
// unset($aq);
// echo $aq."jj";

?>


