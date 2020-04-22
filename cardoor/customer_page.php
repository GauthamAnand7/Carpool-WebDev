<html>
<?php
require "connection.php";
?> 
<?php
  session_start();
 

 // echo "reached here";
 // echo $_SESSION['id'];

  $destlong= $_POST['destlong'];
  
  $deslat = $_POST['destlat'];
  $_SESSION['custId'] = $_SESSION['id'];
  $_SESSION['start_loclat'] = $_POST['srclat'];
  $_SESSION['start_loclong'] = $_POST['srclong'];
  $_SESSION['stop_loclat'] = $_POST['destlat'];
  $_SESSION['stop_loclong'] = $_POST['destlong'];
 // echo "$username";
  $search_cars = "SELECT * from user_table where id in (select DriverId from driver_trips where   stop_loclat = '$deslat');";
  $result =$conn->query($search_cars);
  if($result)
  {
  //  echo "result are processed";
  }
  else
  {
    echo "error";
  }
     
?>

    <head>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet"> 
        <link href="assets/css/plugins/slicknav.min.css" rel="stylesheet">
        <link href="assets/css/plugins/owl.carousel.min.css" rel="stylesheet">
        <!--=== Gijgo CSS ===-->
        <link href="assets/css/plugins/gijgo.css" rel="stylesheet">
        <!--=== FontAwesome CSS ===-->
        <link href="assets/css/font-awesome.css" rel="stylesheet">
        <!--=== Theme Reset CSS ===-->
        <!--=== Main Style CSS ===-->
        <link href="style.css" rel="stylesheet">
        <!--=== Responsive CSS ===-->
        <link href="assets/css/responsive.css" rel="stylesheet">
    
        <link href = "css/login.css" rel="stylesheet">                                                           
     <!--   <script>
            var x = document.getElementById("textbox1");
            function getLocation() {
              if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
              } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
              }
            }
            
            function showPosition(position) {
              x.innerHTML = "Latitude: " + position.coords.latitude +
              "<br>Longitude: " + position.coords.longitude;
            }
            </script>   !-->
    </head>
        <body>
        <div class="container">
        
                <form action="select.php" method="post">
              <ul class="list-group" style="color: black;">
                <?php
              if ($result && $result->num_rows > 0) {
                ?>
                <button style="text-align: center;    
                  top: 80%;
                  left: 50%;
                  background: #ffd000;
                  color: #000;
                  position: absolute;
                  transform: translate(-50%,-50%);
                  box-sizing: border-box;
                  border-radius: 20px;"type = "button" name="search" class="btn btn-primary ali" onclick="get_latlong()">Search</button>
                  <?php
        // output data of each row
        while($row = $result->fetch_assoc()) {
          ?>
          
          <div>
          <li class="list-group-item" style=> <input type="submit" name = "driverid2" id="driverid"  value="<?php echo $row['id']?>" > car_no: <?php echo $row['car_no'];?>  License No:<?php echo $row['license'];?></li>
          </div>
          <?php 
                    $_SESSION['DriverId'] = $row['id'];
          }
    } else {
        echo "0 results";
    }
     ?>
                        
                            </ul>
                            </form>
              </div>
               
                        
          
        </body>
        <script>
        function get_latlong()
          {
            var srclat;
            var srclong;
            var destlat ;
            var destlong
            sourceAddress=document.getElementById("sourceAddress").value;
            axios.get("https://maps.googleapis.com/maps/api/geocode/json",{
              params:{
                address:sourceAddress,
                key:"AIzaSyBsZe9HkLYb4iKEYP_PzwSTSnsC7qp0WG8"
              }
            }).then(function(response)
            {
             // var jsonObj=JSON.parse(response);
              console.log(typeof(response)); 
               srclat = response.data.results[0].geometry.location.lat;
               srclong = response.data.results[0].geometry.location.lng;
              var latitudeinformation = response.data.results[0].geometry.location.lat+" "+response.data.results[0].geometry.location.lng;
              var latitudeLongitude =`<ul class ="list-group"><li class= "list-group-item">${latitudeinformation}</li>`;
                document.getElementById("listItems").innerHTML = latitudeLongitude;

            //  console.log(response["results"]["geometry"]["location"]["lat"]);
            //  console.log(response["results"]["geometry"]["location"]["lng"]);
            })
            .catch(function(error)
            {
              console.log(error);
            })
            destinationAddress=document.getElementById("destinationAddress").value;
            axios.get("https://maps.googleapis.com/maps/api/geocode/json",{
              params:{
                address:destinationAddress,
                key:"AIzaSyBsZe9HkLYb4iKEYP_PzwSTSnsC7qp0WG8"
              }
            }).then(function(response)
            {
               destlat = response.data.results[0].geometry.location.lat;
               destlong = response.data.results[0].geometry.location.lng;
              var latitudeinformation = response.data.results[0].geometry.location.lat+" "+response.data.results[0].geometry.location.lng;
              var latitudeLongitude =`<li class= "list-group-item">${latitudeinformation}</li>`;
             // console.log(response["results"]["geometry"]["location"]["lng"]);
            })
            .catch(function(error)
            {
              console.log(error);
            })
            var data={
              srclat : srclat,
              srclong: srclong,
              destlat: destlat,
              destlong: destlong 
            };
            $.post("customer_page.php",data);
          }
          function distance(lat1, lon1, lat2, lon2, unit) {
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
 </html>
