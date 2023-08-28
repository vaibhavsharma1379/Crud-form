<?php
require_once "../config/config.php";
require_once "../function/function.php";
$conn=mysqli_db_connect("states");
if(isset($_POST['action']) && $_POST['action']=="getCity"){
extract($_POST);
echo "<pre>";print_r($_POST);
$sql="SELECT district from district___sheet1 where States='".$state_name."'";
$query=mysqli_query($conn,$sql);
$rows=mysqli_fetch_all($query);
$rows_count=mysqli_num_rows($query);

if($rows_count>0){
    foreach($rows as $row){
    
        ?>
        
        <option value="<?=$row[0]?>"><?=$row[0]?></option>
        <?php
    }
}
}

if(isset($_POST['action']) && $_POST['action']=="deleteEmp"){
    extract($_POST);
    global $conByMysqliCrud;
    $sql = "DELETE FROM ragistration WHERE emp_id = '".$emp_id."'";
      $result = mysqli_query($conByMysqliCrud, $sql);
       if($result)
       {
        $resp['statuscode']='00';
        $resp['description']='Deleted successfully';
       }
        echo json_encode($resp);
}
if(isset($_POST['action']) && $_POST['action']=="updateEmp"){
    extract($_POST);
    $result= updatedata();
    if($result){
        $resp["statuscode"]="0";
        $resp["description"]="Updated succesfully";
    }
    else{
        $resp["statuscode"]="1";
        $resp["description"]="Something went wrong with connection";
    }
    echo json_encode($resp);
}
?>