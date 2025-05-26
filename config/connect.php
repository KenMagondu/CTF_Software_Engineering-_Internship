<?php


//header('Content-Type: application/json');



$servername = "localhost";
$username = "root";
$password = ""; 
$database = "event_scoreboard";
$port = 3306; 

$con = mysqli_connect($servername, $username, $password, $database, $port);
if($con){
//echo "Database connected successfully";
}else{
    //die(mysqli_error($con));
   // die("Connection failed: " . mysqli_connect_error());
  error_log("Connection failed: " . mysqli_connect_error());
  header('Content-Type: application/json');
  echo json_encode(["success" => "0", "message" => "Connection failed: " . mysqli_connect_error()]);
 // ob_end_flush();
    exit;
    
}
?>