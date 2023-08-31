<!DOCTYPE html>
<html lang="en">
<?php require_once("function/function.php");
require_once "./config/config.php";

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
</head>

<body>

    <div class="container">
        <div id="vaibhav">
            <div class="m-5 d-flex justify-content-between">
                <h2>Employee Details</h2>
                <h3><a href="registration.php">Register Employee</a></h3>
                <div>
                    <form class="form-horizontal" action="ajax/ajax.php" method="post" name="upload_excel" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <input type="submit" name="Export" class="btn btn-success" value="export to excel" onsubmit="" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- <div id="check"></div> -->

            <table id="emptable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Employee Name</th>
                        <th>Father Name</th>
                        <th>Mobile Number</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Skills</th>
                        <th>DOB</th>
                        <th>DOJ</th>
                        <th>State</th>
                        <th>District</th>
                        <th>Designation</th>
                        <th>About Employee</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    getEmpdetails();
                    ?>
                    

                </tbody>

            </table>
            <div style="height:230px"></div>
            <?php
            $headers=[
                "User-Agent:Vaibhav"
            ];
            $ch=curl_init();
            curl_setopt_array($ch,[
                CURLOPT_HTTPHEADER=>$headers,
                CURLOPT_RETURNTRANSFER=>true
            ]);
            curl_setopt($ch,CURLOPT_URL,"http://localhost/crudform/api/getEmployeeData.php?id=135");
            $data=curl_exec($ch);
            var_dump($data);
            curl_close($ch);
            
            $status_code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
            // echo '<tr>';
            // echo '<td>' . $data["emp_id"] . '</td>';
            // echo '<td>' . $data["Employee_name"] . '</td>';
            // echo '<td>' . $data["Father_name"] . '</td>';
            // echo '<td>' . $data["Mobile_number"] . '</td>';
            // echo '<td>' . $data["Age"] . '</td>';
            // echo '<td>' . $data["Gender"] . '</td>';
            // echo '<td>' . $data["Skills"] . '</td>';
            // echo '<td>' . $data["DOB"] . '</td>';
            // echo '<td>' . $data["DOJ"] . '</td>';
            // echo '<td>' . $data["State"] . '</td>';
            // echo '<td>' . $data["District"] . '</td>';
            // echo '<td>' . $data["Designation"] . '</td>';
            // echo '<td>' . $data["About_employee"] . '</td>';
            

            // echo '</tr>';
           
            ?>
            <script>
                
                
                function deleteByID(id) {

                    $.ajax({
                        url: "ajax/ajax.php",
                        type: "POST",
                        data: {
                            "action": "deleteEmp",
                            "emp_id": id
                        },
                        success: function(data, status) {
                            resp = JSON.parse(data);
                            alert(resp.description);

                            //$("#emptable").load(window.location.href + "#emptable");
                            $("#vaibhav").load(window.location.href + " #vaibhav");
                            //  $("#emptable").html(resp);
                        }
                    })

                }
            </script>

        </div>
    </div>

</body>

</html>