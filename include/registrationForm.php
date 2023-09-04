<?php
require_once "./config/config.php";

require_once "function/function.php";
$conn = mysqli_db_connect("states");
if(isset($ID)){

  $empDetails=getEmpDetailsByID("ragistration","emp_id",$ID);
  // echo "<pre>"; print_r($empDetails);
  $fromName="Update Employee Details";
  $buttonName="Update";
  extract($empDetails);
}
else{
  $fromName="Register Employee";
  $buttonName="Register";
}

  if(isset($_POST['register'])){
    $formerr=ragisterUser();
    extract($formerr);
  }
 
  session_start();
  if (!isset($_SESSION["logged_in"]) && !$_SESSION["logged_in"] == "true") { 
    header("Location: loginAdmin.php");
  }
 
?>




<script>
 
</script>
<div class="d-flex justify-content-between">
  <h1 class="mb-3"><?= $fromName?></h1>
  <h3><a href="./empDetails.php" class="btn btn-success">View Employee Details</a></h3>
  <div id="wrap">
        <div class="container">
            <div class="row">
                <form class="form-horizontal" action="ajax/ajax.php" method="post" name="upload_excel" enctype="multipart/form-data">
                    <fieldset>
                        <!-- Form Name -->
                        <legend>Form Name</legend>
                        <!-- File Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="filebutton">Select File</label>
                            <div class="col-md-4">
                                <input type="file" name="file" id="file" class="input-large">
                            </div>
                        </div>
                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="singlebutton">Import data</label>
                            <div class="col-md-4">
                                <button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Import</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <?php
              //  get_all_records();
            ?>
        </div>
    </div>
</div>
<form id="<?php if(isset($ID)) {echo 'EmpForm';}?>" method="post" class="border rounded shadow mb-5" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<?php 
 if(isset($ID)){ ?>
    <input type="hidden" name="emp_id" value="<?=$ID?>" >
    <input type="hidden" name="action" value="updateEmp" >
 <?php }
?>
  <div class="container-fluid container-border m-1">
    <div class="row">
      <div class="col-sm-12 col-lg-6">
        <label for="name">Employee Name:</label><span class="error">*<?php echo $empNameErr; ?></span><br>
        <input type="text" class="form-control" id="name" name="name" value="<?php if(isset($Employee_name)){echo $Employee_name;}?>">

        <br><br>
      </div>
      <div class="col-sm-12 col-lg-6">
        <label for="fathername">Father Name:</label><span class="error">*<?php echo $fatherNameErr; ?></span><br>
        <input type="text" id="fathername" class="form-control" name="fathername" value="<?php if(isset($Employee_name)){echo $Employee_name;}?>"><br><br>
      </div>
    </div>
    <div class="row">
      <div class="col-6">
        <label for="mobile">Mobile Number:</label><span class="error">*<?php echo $mobileNoErr ?></span><br>
        <input type="text" id="mobile" class="form-control" name="mobile" value="<?php if(isset($Mobile_number)){echo $Mobile_number;}?>"><br><br>
      </div>
      <div class="col-6">
        <label for="age">Age:</label><span class="error">*<?php echo $ageErr ?></span><br>
        <input type="number" pattern="[0-9]+" id="age" name="age" class="form-control" style="width: 50px;" value="<?php if(isset($Age)){echo $Age;}?>"><br><br>
      </div>
    </div>
    <div class="row">
      <div class="col-6">
        <label for="gender">Gender:</label><span class="error">*<?php echo $genderErr ?></span><br>
        <div class="d-flex justify-content-start">
          <div>
            <input class="form-check-input" type="radio" id="male" name="gender" value="M" <?php if(isset($Gender) && $Gender=="M"){echo "checked";} elseif(!isset($Gender)){ echo "checked";}?> >
            <label class="form-check-label" for="male">Male</label><br>
          </div>
          <div>
            <input class="form-check-input" type="radio" id="female" name="gender" value="F" <?php if(isset($Gender) && $Gender=="F"){echo "checked";}?>>
            <label class="form-check-label" for="female">Female</label><br>
          </div>

        </div>
      </div>


      <div class="col-6">
        <label for="intrest">Skills:</label>
        <div>

          <input class="form-check-input" name="intrest[]" type="checkbox" value="python"     <?php if(isset($Skills) && str_contains($Skills,"python")){echo "checked";}?> id="python" />
          <label class="form-check-label" for="python">Python</label>
          <input class="form-check-input" name="intrest[]" type="checkbox" value="java"       <?php if(isset($Skills) && str_contains($Skills,"java")){echo "checked";}?> id="java" />
          <label class="form-check-label" for="java">Java</label>
          <input class="form-check-input" name="intrest[]" type="checkbox" value="php"        <?php if(isset($Skills) && str_contains($Skills,"php")){echo "checked";}?> id="php" />
          <label class="form-check-label" for="php">PHP</label>
          <input class="form-check-input" name="intrest[]" type="checkbox" value="c++"        <?php if(isset($Skills) && str_contains($Skills,"c++")){echo "checked";}?> id="c++" />
          <label class="form-check-label" for="c++">C++</label>
          <input class="form-check-input" name="intrest[]" type="checkbox" value="dart"       <?php if(isset($Skills) && str_contains($Skills,"dart")){echo "checked";}?> id="dart" />
          <label class="form-check-label" for="dart">Dart</label>
          <input class="form-check-input" name="intrest[]" type="checkbox" value="javascript" <?php if(isset($Skills) && str_contains($Skills,"javascript")){echo "checked";}?> id="javascript" />
          <label class="form-check-label" for="javascript">Javascript</label>
        </div>
      </div>

    </div>
    <br><br>
    <div class="row">
      <div class="col-sm-12 col-lg-6">
        <label for="dob">Date Of Birth:</label><span class="error">*<?php echo $doberr ?></span>
        <input class="form-control" type="date" id="dob" , name="dob" value="<?php if(isset($DOB)){echo $DOB;}?>"/>
      </div>

      <div class="col-sm-12 col-lg-6">
        <label for="doj">Date Of Joining:</label><span class="error">*<?php echo $dojErr ?></span>
        <input class="form-control" type="date" id="doj" , name="doj" value="<?php if(isset($DOJ)){echo $DOJ;}?>"/>
      </div>
    </div>
    <br><br>
    <div class="row">
      <div class="col-sm-12 col-lg-6  mt-3 mb-3">
        <label for="state" class="m-2">State:</label><br>
        <select id="State" class="form-select" name="state">
          <option value="<?php if(isset($State)){echo $State;} else{echo "";}?>"><?php if(isset($State)){echo $State;} else{echo "--Please choose an option--";}?></option>
          <?php
          $sql = "SELECT distinct States FROM district___sheet1 order by States ASC";
          $query = mysqli_query($conn, $sql);
          $rows_count = mysqli_num_rows($query);
          $rows = mysqli_fetch_all($query);
          if ($rows_count > 0) {
            foreach ($rows as $row) {


              echo '<option value="'.$row[0].'">'.$row[0].'</option>';
            }
          }
          //  echo $rowss;
          ?>
        </select>
      </div>
      <br><br>
      <div class="col-sm-12 col-lg-6 mb-3 mt-3">
        <label for="district" class="m-2">District:</label><br>
        <select id="district" class="form-select" name="district">
          <option value="<?php if(isset($District)){echo $District;} else{echo "";}?>"><?php if(isset($District)){echo $District;} else{echo "--Please choose an option--";}?></option>

        </select>
      </div>
    </div>
    <br><br>
    <div class="mb-3 mt-3">
      <label for="designation" class="m-2">Designation:</label><br>
      <select class="form-select" id="designation" name="designation" value="<?php if(isset($Designation)){echo $Designation;}?>">
        <option value="<?php if(isset($Designation)){echo $Designation;} else{echo "";}?>"><?php if(isset($Designation)){echo $Designation;} else{echo "--Please choose an option--";}?></option>
        <option value="manager">Manager</option>
        <option value="engineer">Engineer</option>
        <option value="analyst">Analyst</option>
        <option value="developer">Developer</option>
      </select>
    </div>
    <br><br>
    <label for="about">About Employee:</label><span class="error">*<?php echo $aboutErr ?></span><br>
    <textarea class="form-control" id="about" name="about" rows="4" cols="50"><?php if(isset($About_employee)){echo $About_employee;}?></textarea><br><br>
    <button  class="mb-4" type="submit" value="<?php echo (isset($ID)) ? 'update' : 'register'; ?>" name="<?php echo (isset($ID)) ? 'update' : 'register'; ?>"><?=$buttonName?></button>
  </div>
</form>
<script>

  $(document).ready(function(){
    $("#EmpForm").on('submit',function(e){
        e.preventDefault();
        var form = $(this);
        $.ajax({
        url:'ajax/ajax.php',
        type:'POST',
        data:form.serialize(),
        success:function(data){
          resp = JSON.parse(data);
          alert(resp.description);
          $("#emptable").load(window.location.href + "#emptable");
        }
        });
      });
    });
</script>

 