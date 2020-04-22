<?php
session_start();
require "connection.php";
$srclat = $_POST["srclat"];
$srclong = $_POST['srclong'];
$destlat = $_POST['destlat'];
$destlong = $_POST['destlong'];
$username = $_SESSION['user'];
$password = $_SESSION['pwd'];
$insert_username = "SELECT id from user_table where name = '$username' and password = '$password' and type = 'driver'";
  $result = $conn->query($insert_username);
  $row =$result->fetch_assoc();
  $id = $row['id'];
  //echo "Value of id is";
 // echo $username;
//  echo $password;
$query = "INSERT INTO driver_trips (DriverId,start_loclat,start_loclong,stop_loclat,stop_loclong) values ($id,'$srclat','$srclong','$destlat','$destlong');";
$result = $conn->query($query);
if($result)
{
    echo "Succesful";
}
else
{
    echo " error";
}
echo $result;
echo $srclat;
echo "REached here";
?>