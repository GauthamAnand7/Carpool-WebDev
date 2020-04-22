<?php
require "connection.php";
session_start();
?> 
<?php
$username = $_SESSION['user'];
$password = $_SESSION['pwd'];
echo $username;
echo $password;
$insert_username = "SELECT id from user_table where name = '$username' and password = '$password' and type = 'driver'";
  $result = $conn->query($insert_username);
  $row =$result->fetch_assoc();
  $id = $row['id'];
  echo $id;
    $result1 = $conn->query("select * from driver_trips where DriverId = $id and stop_time is NULL");
    if($result1){
    $row = $result1->fetch_assoc();
    $dtid = $row['DriverTripId'];
  $insert_username = "update driver_trips set stop_time=CURRENT_TIMESTAMP() where DriverTripId = '$dtid' ";
  $result = $conn->query($insert_username);
  if($result){
        $row =$result->fetch_assoc();

          session_destroy();
           echo "Session destroyed";
      header("Location:index.html");
           exit();
        }else {
           $error = "Your trip is invalid";
           echo $error;
           header("Location:index.html"); 

        }
  }
  else
  {
    header("Location:index.html"); 
  }
?>
