<?php
//  require_once "./config/config.php";
function getEmpDetailsByID($tableName,$key,$keyVal){
global $conByMysqliCrud;
    $data = '';
    $sql = "SELECT * FROM " . $tableName . " WHERE  $key= '" . $keyVal . "' LIMIT 1";
    //echo $sql; die();
    $result = mysqli_query($conByMysqliCrud, $sql);
    $rows = mysqli_num_rows($result);
    if ($rows > 0) {
        $data = mysqli_fetch_assoc($result);
    }
        
    return $data;

}
function updatedata(){
    global $conByMysqliCrud;
    print_r($_POST);
        $emp_id=$_POST['emp_id'];
        $emp_name=$_POST['name'];
        $fathers_name=$_POST['fathername'];
        $mobile_number=$_POST['mobile'];
        $age=$_POST['age'];
        $gender=$_POST['gender'];
        if(isset($_POST['intrest']))
        {
            $Skills = implode(',',$_POST['intrest']);
        }else{
            $Skills = '';
        }
       // $Skills=$_POST['intrest'];
        $dob=$_POST['dob'];
        $doj=$_POST['doj'];
        $state=$_POST['state'];
        $district=$_POST['district'];
        $designation=$_POST['designation'];
        $about=$_POST['about'];
        $query="UPDATE ragistration SET Employee_name='$emp_name',Father_name='$fathers_name',Mobile_number='$mobile_number',Age='$age',Gender='$gender',Skills='$Skills',DOB='$dob',DOJ='$doj',State='$state',District='$district',Designation='$designation',About_employee='$about'  where emp_id=$emp_id";
    
       $result=mysqli_query($conByMysqliCrud,$query);
       $rows = mysqli_num_rows($result);
       if ($rows > 0) {
        $data = mysqli_fetch_assoc($result);
     }
        
    return $data;
    
}

?>