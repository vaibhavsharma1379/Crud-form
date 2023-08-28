<?php
function PDO_db_connect(){

    try{
       
        $conn =new PDO("mysql:host=localhost;dbname=crud operation",'me_user','1234');
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        // echo "connected succesfully";
        return $conn;
    }
    catch(PDOException $e){
    echo "connection Failled:" .$e->getMessage();
    }
}
function mysqli_db_connect($dbname){
    $server="localhost";
    $username="me_user";
    $password="1234";
    
    $conn=mysqli_connect($server,$username,$password,$dbname);
    if(!$conn){
        die(" mysqli conection failled:" .mysqli_connect_error());
        
    }
    // echo "mysqli connected successfully";
    return $conn;
}
$conByMysqliCrud=mysqli_db_connect("crud operation");
?>