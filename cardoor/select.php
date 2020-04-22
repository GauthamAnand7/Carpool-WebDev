<?php
require "connection.php";
?> 
<?php
session_start();
$id = $_POST['driverid2'];
echo "reached here";
  $driverid= $_SESSION['DriverId'];
 // echo "$username";
 $start_loclat = $_SESSION['start_loclat'] ;
 $custId = $_SESSION['custId'];
 //$id = '127';//$_SESSION['id'];
 $start_loclong = $_SESSION['start_loclong'];
 $stop_loclat = $_SESSION['stop_loclat'];
 $stop_loclong = $_SESSION['stop_loclong'];
 echo $id."<br>";
 echo $driverid;
 echo "gotthis".$start_loclat."<br>";
 echo $start_loclang."<br>";
 echo "got this".$stop_loclat."<br>";
 echo $custId."<br>";
 echo $_SESSION['login_user'];
 echo "got this".$stop_loclong."<br>";
 $insert_custtrip = "insert into cust_trips(driverId,custId,start_time,start_loclat,start_loclong,stop_loclat,stop_loclong) values($id,$custId,CURRENT_TIMESTAMP(),$start_loclat,'12.54',$stop_loclat,$stop_loclong);";
 $result = mysqli_query($conn,$insert_custtrip);

 if($result){
    $result = $conn->query("select * from cust_trips where CustId =$custId");
        $_SESSION['tripid'] = $row["tripid"];
        echo $_SESSION['tripid'];
         
    header("Location:maps.php");
         exit();
      }else {
         $error = "Your selection is invalid reached hereSS";
         echo $error;
      }

?>