<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empdetails Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

</head>


<body>

    <div class="container">
        <div class="mt-5 d-flex justify-content-between">
            <?php require_once("function/function.php");
            require_once "./config/config.php";
            session_start();
            if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == "true") { ?>
                <h1 style="font-family:Georgia, 'Times New Roman', Times, serif; color:white">Welcome <span style="color:brown"><?php echo $_SESSION['email'] ?></span></h1>
                <p><a href='logout.php' class="btn btn-success" type="submit">Logout</a></p>
            <?php
            } else {
                // redirect to login page
                header("Location: loginAdmin.php");
            }

            ?>
        </div>
        <div id="vaibhav">
            <div class="mt-5 d-flex justify-content-between">
                <h2 style="font-family:Georgia, 'Times New Roman', Times, serif; color:white">Employee Details</h2>
                <h3><a href="registration.php" class="btn btn-success">Register Employee</a></h3>
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

            <table id="emptable" class="table table-striped table-hover  border rounded">
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
                        <th colspan="2">Action</th>
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
            $headers = [
                "User-Agent:Vaibhav"
            ];
            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_RETURNTRANSFER => true
            ]);
            curl_setopt($ch, CURLOPT_URL, "http://localhost/crudform/api/getEmployeeData.php?id=231");
            $data = curl_exec($ch);

            curl_close($ch);

            //    print_r($data);
            //   $data=(array)$data;
            // $data_obj = json_decode($data);
            $data_array = json_decode($data, true);

            // print_r($data_array);
            $status_code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);

            echo '<tr>';
            echo '<td>' . $data_array["emp_id"] . '</td>';
            echo '<td>' . $data_array["Employee_name"] . '</td>';
            echo '<td>' . $data_array["Father_name"] . '</td>';
            echo '<td>' . $data_array["Mobile_number"] . '</td>';
            echo '<td>' . $data_array["Age"] . '</td>';
            echo '<td>' . $data_array["Gender"] . '</td>';
            echo '<td>' . $data_array["Skills"] . '</td>';
            echo '<td>' . $data_array["DOB"] . '</td>';
            echo '<td>' . $data_array["DOJ"] . '</td>';
            echo '<td>' . $data_array["State"] . '</td>';
            echo '<td>' . $data_array["District"] . '</td>';
            echo '<td>' . $data_array["Designation"] . '</td>';
            echo '<td>' . $data_array["About_employee"] . '</td>';

            echo '</tr>';

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

<style>
    body {
        background: url(image/1107225.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
</style>