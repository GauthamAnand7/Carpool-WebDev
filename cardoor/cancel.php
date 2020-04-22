<?php
require "connection.php";
session_start();
?> 
<html>
<body>
  <p id = "result"></p>
<script>
function distance(lat1, lon1, lat2, lon2, unit) {
  console.log("Reached here");
  document.getElementById("result").value = "thi si a";
                  if ((lat1 == lat2) && (lon1 == lon2)) {
                    return 0;
                  }
                  else {
                    var radlat1 = Math.PI * lat1/180;
                    var radlat2 = Math.PI * lat2/180;
                    var theta = lon1-lon2;
                    var radtheta = Math.PI * theta/180;
                    var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
                    if (dist > 1) {
                      dist = 1;
                    }
                    dist = Math.acos(dist);
                    dist = dist * 180/Math.PI;
                    dist = dist * 60 * 1.1515;
                    if (unit=="K") { dist = dist * 1.609344 }
                    if (unit=="N") { dist = dist * 0.8684 }
                    return dist;
                    document.getElementById("result").value = dist;
                  }
                }
        </script>

<?php
//session_start();
 if(isset($_POST['submit']))
{
  $tripid= $_SESSION['tripid'];
  $cost =  rand(100,300);
 //// echo $_SESSION['custId'];
  $custId = $_SESSION['custId'];
  $findId = "select tripId from cust_trips where custId = $custId";
  $result2 = $conn->query($findId);
  $row2 =$result2->fetch_assoc();
  $tripid = $row2['tripId'];
 // echo "Reached here";
 // echo $tripid;
  $update_trip = "update cust_trips set stop_time = CURRENT_TIMESTAMP() where tripId = $tripid";
  $result = $conn->query( $update_trip );
  if($result){
 //   echo "rEACHED Here";
      $update_trip = "select * from cust_trips where tripId = $tripid";
  $result = $conn->query( $update_trip );
 //  echo" reached here";
  $row =$result->fetch_assoc();
     // $cost = distance($row['start_loclat'],$row['start_loclong'],$row['stop_loclat'],$row['stop_loclong'],"K") * 35;
     ?>
          
          <html>
<head>
<title>Login Form Design</title>
    <link rel="stylesheet" type="text/css" href="css\login.css">

<body>
    <div class="loginbox">
        <h1>Cash Payment</h1>
        <li  class="list-group-item">Start Time:<?php echo $row['start_time'] ?></li><br>
        <li  class="list-group-item">End   Time:<?php echo(date("Y-m-d",time()))?><br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <li  class="list-group-item">Amount to be paid:<?php echo "$cost" ?></li><br>

        
 </li>

        
    </div>

</body>
</head>
</html>
     <?php 
   //  echo "<h1>Trip cost is<h1>";
  //    echo "<h1> Trip Cost is"+rand(100,250)+"</h1>";
      session_destroy();
   //    $cost = distance($row['start_loclat'],$row['start_loclong'],$row['stop_loclat'],$row['stop_loclong'],"K") * 35;
     //   echo "Cost = $cost";
         exit();
      }else {
         $error = "Your Login Name or Password is invalid";
         echo $error;
      }
}
else
{
 echo "Button not pressed";
 exit();
}
?>
<script>
function distance(lat1, lon1, lat2, lon2, unit) {
  console.log("Reached here");
                  if ((lat1 == lat2) && (lon1 == lon2)) {
                    return 0;
                  }
                  else {
                    var radlat1 = Math.PI * lat1/180;
                    var radlat2 = Math.PI * lat2/180;
                    var theta = lon1-lon2;
                    var radtheta = Math.PI * theta/180;
                    var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
                    if (dist > 1) {
                      dist = 1;
                    }
                    dist = Math.acos(dist);
                    dist = dist * 180/Math.PI;
                    dist = dist * 60 * 1.1515;
                    if (unit=="K") { dist = dist * 1.609344 }
                    if (unit=="N") { dist = dist * 0.8684 }
                    return dist;
                  }
                }
        </script>
</body>
</html>