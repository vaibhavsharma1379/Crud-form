<!DOCTYPE html>
<html lang="en">

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
    <div>
        <div class="m-5 d-flex justify-content-between">
            <h2>Employee Details</h2>
            <h3><a href="registration.php">Register Employee</a></h3>
        </div>
        <div id="check"></div>

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
                <?php require("function/getEmpDEtails.php") ?>


            </tbody>

        </table>
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
                        $("#emptable").load(window.location.href + "#emptable");
                    }
                })
            }
        </script>

    </div>
</body>

</html>