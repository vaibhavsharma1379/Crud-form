<?php
require_once './config/config.php';
$conn = PDO_db_connect();
$query = $conn->prepare("SELECT * FROM ragistration");
$query->execute();
$rows = $query->rowCount();


if ($rows > 0) {
    while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
       
        $ID=$data["emp_id"];
         
                echo '<tr>';
                echo '<td>'.$data["emp_id"].'</td>';
                echo '<td>'.$data["Employee_name"].'</td>';
                echo '<td>'.$data["Father_name"].'</td>';
                echo '<td>'.$data["Mobile_number"].'</td>';
                echo '<td>'.$data["Age"].'</td>';
                echo '<td>'.$data["Gender"].'</td>';
                echo '<td>'.$data["Skills"].'</td>';
                echo '<td>'.$data["DOB"].'</td>';
                echo '<td>'.$data["DOJ"].'</td>';
                echo '<td>'.$data["State"].'</td>';
                echo '<td>'.$data["District"].'</td>';
                echo '<td>'.$data["Designation"].'</td>';
                echo '<td>'.$data["About_employee"].'</td>';
                echo '<td><a href="./registration.php?id='.$ID.'" class="btn btn-danger">EDIT</a></td>';
                echo '<td><a onclick="deleteByID('.$ID.')" class="btn btn-danger">Delete</a></td>';

        echo '</tr>';


    }
}
