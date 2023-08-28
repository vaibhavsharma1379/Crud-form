<?php
require_once "./config/config.php";
require_once "function.php";
$conn=PDO_db_connect();
$conn_mysqli=mysqli_db_connect("crud operation");
// echo 12535312;
function test_input($data){
    $data=trim($data);
    $data=stripcslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}

$empNameErr=$fatherNameErr=$genderErr=$mobileNoErr=$ageErr=$aboutErr=$doberr=$dojErr="";
$emp_name=$fathers_name= $about=$designation= $district= $state=$doj=$dob=$Skills= $gender=$age= $mobile_number="";

if(isset($_POST['register'])){
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
     

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
       // echo "<pre>" ;echo $Skills; die('kk');

        // name validation function
        function nameErr($emp_name){
            $nameErr="";
            if(empty($emp_name)|| strlen(trim($emp_name))<=0){
                $nameErr="Name is required";
                
            }
            else{
                $emp_name=test_input($emp_name);
                if(!preg_match("/^[a-zA-Z-' ]*$/",$emp_name)){
                    $nameErr="Only letters and white space allowed";
                }
            }
            return $nameErr;
        }
        $empNameErr=nameErr($emp_name);
       
        $fatherNameErr=nameErr($fathers_name);
        

        // gender Validation
        if(empty($gender)){
            $genderErr="Gender is required";
        }
        else{
            $gender=test_input($gender);
        }
    
        // About validation
        if(empty($about)){
            $about="";
        }
        else{
            $about=test_input($about);
        }

        // Validating phone number

        if(empty($mobile_number)||strlen(trim($mobile_number))<=0){
        $mobileNoErr="Enter Mobile Please";
        }elseif(!preg_match('/^[0-9]{10}+$/',$mobile_number)){
            $mobile_number="Enter valid mobile number";
        }
        else{
            $mobile_number=test_input($mobile_number);
        }

        // validating dob 
        function validateDate($date){
            if(empty($date)){
                return "please enter Date";
            }
            
        }

        $doberr=validateDate($dob);
        $dojErr=validateDate($doj);

        // age validation 

        if(empty($age))
        {
            $ageErr="please enter age of employee";
        }
        else{
            $age=test_input($age);
        }
        
    if($empNameErr=="" && $fatherNameErr==""&& $genderErr=="" && $mobileNoErr=="" && $ageErr=="" && $aboutErr=="" && $doberr==""&& $dojErr==""){
        
        
        
            echo "New record created successfully";
        $sql="INSERT INTO ragistration (
            `Employee_name`,
            `Father_name`,
            `Mobile_number`,
            `Age`,
            `Gender`,
            `Skills`,
            `DOB`,
            `DOJ`,
            `State`,
            `District`,
            `Designation`,
            `About_employee`) 
            VALUES 
            ('$emp_name',
            '$fathers_name',
            '$mobile_number', 
            '$age',
            '$gender',
            '$Skills', 
            '$dob',
            '$doj',
            '$state',
            '$district',
            '$designation',
            '$about')";

        $conn->exec($sql);
      
        echo "New record created successfully";
        
    }
    else{
        echo "alert('somthing went wrong')";
    }
    
    

    
}
}
