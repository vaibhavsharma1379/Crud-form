<?php
function send_mail()
{
    $msg = "First line of text\nSecond line of text";

    // use wordwrap() if lines are longer than 70 characters
    $msg = wordwrap($msg, 70);

    // send email
    mail("someone@example.com", "My subject", $msg);
}
function ragisterAdmin()
{
    global $connPDO;
    // print_r("yju6jjujuj");
    // print_r($_POST);
    extract($_POST);
    // print_r($email);
    $query = $connPDO->prepare('SELECT * FROM admins where email="' . $email . '"');
    $query->execute();
    $row = $query->rowCount();
    if ($row == 0) {
        if ($password === $confirm_password) {
            $psw = md5($password);

            $sql = $connPDO->prepare("INSERT INTO admins ( 
                email ,
                password,
                mobile,
                login_ip,
                status
             ) VALUES(?,?,?,?,?)");
            $query = $sql->execute([
                $email,
                $psw,
                $mobile,
                $_SERVER['HTTP_HOST'],
                $status

            ]);
            if ($query) {
                echo "<script>alert('Admin ragistered succesfully');</script>";
                header("Location:loginAdmin.php");
            } else {
                echo "<script>alert('somthing went wrong');</script>";
            }
        } else {
            echo "<script>alert('password does not match');</script>";
        }
    } else {
        echo "<script>alert('user already exist');</script>";
    }
}
function ragisterUser()
{



    $emp_name = $fathers_name = $about = $designation = $district = $state = $doj = $dob = $Skills = $gender = $age = $mobile_number = "";
    global $connPDO;
    if (isset($_POST['register'])) {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {


            $emp_name = $_POST['name'];
            $fathers_name = $_POST['fathername'];
            $mobile_number = $_POST['mobile'];
            $age = $_POST['age'];
            $gender = $_POST['gender'];
            if (isset($_POST['intrest'])) {
                $Skills = implode(',', $_POST['intrest']);
            } else {
                $Skills = '';
            }
            // $Skills=$_POST['intrest'];
            $dob = $_POST['dob'];
            $doj = $_POST['doj'];
            $state = $_POST['state'];
            $district = $_POST['district'];
            $designation = $_POST['designation'];
            $about = $_POST['about'];
            // echo "<pre>" ;echo $Skills; die('kk');

            // name validation function

            $empNameErr = nameErr($emp_name);

            $fatherNameErr = nameErr($fathers_name);


            // gender Validation
            $genderErr = genderErr($gender);

            // About validation
            $aboutErr = aboutvaliadtion($about);

            // Validating phone number

            // $mobileNoErr = mobileNoValidation($mobile_number);
            $mobileNoErr = "";
            // validating dob 


            $doberr = validateDate($dob);
            $dojErr = validateDate($doj);

            // age validation 
            $ageErr = ageValidation($age);


            if ($empNameErr == "" && $fatherNameErr == "" && $genderErr == "" && $mobileNoErr == "" && $ageErr == "" && $aboutErr == "" && $doberr == "" && $dojErr == "") {

                $sql = $connPDO->prepare("INSERT INTO ragistration ( 
                    Employee_name,
                Father_name,
                Mobile_number,
                Age,
                Gender,
                Skills,
                DOB,
                DOJ,
                State,
                District,
                Designation,
                About_employee) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
                $query = $sql->execute([
                    $emp_name,
                    $fathers_name,
                    $mobile_number,
                    $age,
                    $gender,
                    $Skills,
                    $dob,
                    $doj,
                    $state,
                    $district,
                    $designation,
                    $about
                ]);
                // print_r($query);
                if ($query) {
                    echo "<script>alert('Employee ragister succesfully');</script>";
                } else {
                    echo "<script>alert('somthing went wrong');</script>";
                }
            }
            return array("empNameErr" => $empNameErr, "fatherNameErr" => $fatherNameErr, "genderErr" => $genderErr, "mobileNoErr" => $mobileNoErr, "ageErr" => $age, "aboutErr" => $aboutErr, "doberr" => $doberr, "dojErr" => $dojErr);
        }
    }
}
function getEmpDetailsByID($tableName, $key, $keyVal)
{
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
function nameErr($emp_name)
{
    $nameErr = "";
    if (empty($emp_name) || strlen(trim($emp_name)) <= 0) {
        $nameErr = "Name is required";
    } else {
        $emp_name = test_input($emp_name);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $emp_name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }
    return $nameErr;
}
function genderErr($gender)
{
    $genErr = "";
    if (empty($gender)) {
        $genderErr = "Gender is required";
    } else {
        $gender = test_input($gender);
    }
    return $genErr;
}
function aboutvaliadtion($about)
{
    $aboutErr = "";
    if (empty($about)) {
        $about = "";
    } else {
        $about = test_input($about);
    }
    return $aboutErr;
}
function mobileNoValidation($mobile_number)
{
    $mobileNoErr = "";
    if (empty($mobile_number) || strlen(trim($mobile_number)) <= 0) {
        $mobileNoErr = "Enter Mobile Please";
    } elseif (!preg_match('/^[0-9]{10}+$/', $mobile_number)) {
        $mobileNoErr = "Enter valid mobile number";
    } else {
        $mobile_number = test_input($mobile_number);
    }
    return $mobileNoErr;
}
function validateDate($date)
{
    if (empty($date)) {
        return "please enter Date";
    }
}
function ageValidation($age)
{
    $ageErr = "";
    if (empty($age)) {
        $ageErr = "please enter age of employee";
    } else {
        $age = test_input($age);
    }
    return $ageErr;
}
function updatedata()
{

    global $conByMysqliCrud;
    // print_r($_POST);
    $emp_id = $_POST['emp_id'];
    $emp_name = $_POST['name'];
    $fathers_name = $_POST['fathername'];
    $mobile_number = $_POST['mobile'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    if (isset($_POST['intrest'])) {
        $Skills = implode(',', $_POST['intrest']);
    } else {
        $Skills = '';
    }

    $dob = $_POST['dob'];
    $doj = $_POST['doj'];
    $state = $_POST['state'];
    $district = $_POST['district'];
    $designation = $_POST['designation'];
    $about = $_POST['about'];

    $query = "UPDATE ragistration SET Employee_name='$emp_name',Father_name='$fathers_name',Mobile_number='$mobile_number',Age='$age',Gender='$gender',Skills='$Skills',DOB='$dob',DOJ='$doj',State='$state',District='$district',Designation='$designation',About_employee='$about'  where emp_id=$emp_id";

    $result = mysqli_query($conByMysqliCrud, $query);
    return $result;
}
$empNameErr = $fatherNameErr = $genderErr = $mobileNoErr = $ageErr = $aboutErr = $doberr = $dojErr = " ";
function loginAdmin()
{
    global $connPDO;
    extract($_POST);
    // print_r($email);
    $query = $connPDO->prepare('SELECT * FROM admins where email="' . $email . '"');
    $query->execute();
    $row = $query->rowCount();

    if ($row > 0) {
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $email = $data["email"];
        $adminPassword = $data["password"];
        if ($adminPassword == md5($password)) {
            $_SESSION['email'] = $email;
            $_SESSION['logged_in'] = true;
            if (!empty($remember)) {
                // print_r('wregrewgtrehterhteh');
                setcookie('email', $email, time() + (3600 * 24 * 2));
                setcookie('password', $password, time() + (3600 * 24 * 2));
            }

            header("Location:empDetails.php");
            echo "<script>alert('$email login successfully')</script>";
        } else {
            echo "<script>alert('email or password incorrect')</script>";
        }
        // 
    } else {
        echo "<script>alert('User does not exist please register user first')</script>";
    }
}

function getEmpdetails()
{
    global $connPDO;
    // print_r($connPDO);
    // die();
    $query = $connPDO->prepare("SELECT * FROM ragistration");
    $query->execute();
    $rows = $query->rowCount();


    if ($rows > 0) {
        while ($data = $query->fetch(PDO::FETCH_ASSOC)) {

            $ID = $data["emp_id"];

            echo '<tr>';
            echo '<td>' . $data["emp_id"] . '</td>';
            echo '<td>' . $data["Employee_name"] . '</td>';
            echo '<td>' . $data["Father_name"] . '</td>';
            echo '<td>' . $data["Mobile_number"] . '</td>';
            echo '<td>' . $data["Age"] . '</td>';
            echo '<td>' . $data["Gender"] . '</td>';
            echo '<td>' . $data["Skills"] . '</td>';
            echo '<td>' . $data["DOB"] . '</td>';
            echo '<td>' . $data["DOJ"] . '</td>';
            echo '<td>' . $data["State"] . '</td>';
            echo '<td>' . $data["District"] . '</td>';
            echo '<td>' . $data["Designation"] . '</td>';
            echo '<td>' . $data["About_employee"] . '</td>';
            echo '<td><a href="./registration.php?id=' . $ID . '" class="btn btn-primary">EDIT</a></td>';
            echo '<td><a onclick="deleteByID(' . $ID . ')" class="btn btn-danger">Delete</a></td>';

            echo '</tr>';
        }
    }
}
function test_input($data)
{
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function exportEmpData()
{
    global $conByMysqliCrud;
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=data.csv');
    $output = fopen("php://output", "w");
    fputcsv($output, array(
        'emp_id',
        'Employee_name',
        'Father_name',
        'Mobile_number',
        'Age',
        'Gender',
        'Skills',
        'DOB',
        'DOJ',
        'State',
        'District',
        'Designation',
        'About_employee'
    ));
    $query = "SELECT * FROM ragistration";
    $result = mysqli_query($conByMysqliCrud, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, $row);
    }
    fclose($output);
}
function importDAta()
{
    global $conByMysqliCrud;
    $filename = $_FILES["file"]["tmp_name"];
    if ($_FILES["file"]["size"] > 0) {
        $file = fopen($filename, "r");

        $keys = fgetcsv($file);
        while (($getDataValues = fgetcsv($file, 10000, ",")) !== FALSE) {
            $data = array_combine($keys, $getDataValues);
            extract($data);
            $sql = "INSERT INTO ragistration ( 
             Employee_name,
             Father_name,
             Mobile_number,
             Age,
             Gender,
             Skills,
             DOB,
             DOJ,
             State,
             District,
             Designation,
             About_employee) VALUES (
               '$Employee_name',
             '$Father_name',
             '$Mobile_number',
             '$Age',
             '$Gender',
             '$Skills',
             '$DOB',
             '$DOJ',
             '$State',
             '$District',
             '$Designation',
             '$About_employee'
)";
            $result = mysqli_query($conByMysqliCrud, $sql);
            if (!isset($result)) {
                echo "<script type=\"text/javascript\">
              alert(\"Invalid File:Please Upload CSV File.\");
              window.location = \"../registration.php\"
              </script>";
            } else {
                echo "<script type=\"text/javascript\">
            alert(\"CSV File has been successfully Imported.\");
            window.location = \"../registration.php\"
           </script>";
            }
        }


        fclose($file);
    }
}
function updateAdminPasswordByMail($token)
{
    global $connPDO;
    extract($_POST);
    $password = md5($password);
    $query = $connPDO->prepare('UPDATE admins SET password="' . $password . '" WHERE token ="' . $token . '"');
    $query->execute();
    $row = $query->rowCount();
    if ($row > 0) {
        header("Location:loginAdmin.php");
    } else {
        echo "<script>something went wrong</script>";
    }



    // UPDATE ragistration SET Employee_name='$emp_name',Father_name='$fathers_name',Mobile_number='$mobile_number',Age='$age',Gender='$gender',Skills='$Skills',DOB='$dob',DOJ='$doj',State='$state',District='$district',Designation='$designation',About_employee='$about'  where emp_id=$emp_id";
}
function updateAdminPasswordByOTP()
{
    global $connPDO;
    extract($_POST);
    $password = md5($password);
    $query = $connPDO->prepare('UPDATE admins SET password="' . $password . '" WHERE email="' . $email . '"');
    $query->execute();
    $row = $query->rowCount();
    if ($row > 0) {
        header("Location:loginAdmin.php");
    } else {
        echo "<script>something went wrong</script>";
    }



    // UPDATE ragistration SET Employee_name='$emp_name',Father_name='$fathers_name',Mobile_number='$mobile_number',Age='$age',Gender='$gender',Skills='$Skills',DOB='$dob',DOJ='$doj',State='$state',District='$district',Designation='$designation',About_employee='$about'  where emp_id=$emp_id";
}
