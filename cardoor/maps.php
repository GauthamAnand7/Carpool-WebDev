<?php
        session_start();

?>
<HTML>
    <head>
      
        <link href = "css/bootstrap.min.css" rel="stylesheet">
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
        <title>Simple Map</title>
        <meta name="viewport" content="initial-scale=1.0">
        <meta charset="utf-8">
        <style>
          /* Always set the map height explicitly to define the size of the div
           * element that contains the map. */
          #map {
            height: 600px;
            widows: 100%;
          }
        </style>
      </head>
      <body style="background-image: none;">
        <div class ="container-fluid" style="background-color:black;">
            <header id="header-area" class="fixed-top">
                <!--== Header Top Start ==-->
                <div id="header-top" class="d-none d-xl-block">
                    <div class="container">
                        <div class="row">
                            <!--== Single HeaderTop Start ==-->
                           <div class="row">
                               <p> Your Trips</p>
                               <nav class="mainmenu alignright">
                                <ul>
                                    <li><a href="./index.html">Logout</a></li>
                                </ul>
                            </nav>
                           </div>
                    </div>
                </div>
            </header>
        </div>
        <p id="demo" style="visibility:hidden;"></p>
        <?php 
            require "connection.php";
            // echo "<h1>Eroore</h1>";
            // echo "<h1>Eroore</h1>";
            // echo "<h1>Eroore</h1>";
            // echo "<h1>Eroore</h1>";
            // echo "<h1>Eroore</h1>";
            // echo "<h1>Eroore</h1>";
            // echo "<h1>Eroore</h1>";
         
      //      echo "<h1>Eroore</h1>";

            $driverid = $_SESSION['Drivertripid'];
            $driverid = '144';
         //   echo "reached here";
            $get_loc = "(SELECT * from driver_trips where DriverId = $driverid);";
            $result = $conn->query($get_loc);
            if($result->num_rows > 0){
              $row =$result->fetch_assoc();
              $_SESSION['dstart_loclat'] = $row['start_loclat'];
              $_SESSION['dstart_loclong'] = $row['start_loclong'];
              $_SESSION['dstop_loclat'] = $row['stop_loclat'];
              $_SESSION['dstop_loclong'] = $row['stop_loclong'];
              $cust_start = $_SESSION['start_loclat'];
              $cust_start2 = $_SESSION['start_loclong'];
              $cust_location = $_SESSION['stop_loclat'];
              $cust_location2 = $_SESSION['stop_loclong'];
         //     echo $row['start_loclat'];
           //   echo"this is a";
           //   echo "value is "+$cust_location;
           //   echo "this is a";
           //   echo $_SESSION['tripid'];
           //   echo "Successful";
            }
            else{
            //  echo "<h1>ERROR</h1>";
            }
            ?>
        
        <script>
                      var map;
                      getLocation();
        var x = document.getElementById("demo");
        
        function getLocation() {
            console.log("The input entered here");
          if (navigator.geolocation) {
            navigator.geolocation.watchPosition(showPosition);
          } else { 
            x.innerHTML = "Geolocation is not supported by this browser.";
          }
        }
        function showPosition(position) {
            lat = position.coords.latitude;
            longitude_1 = position.coords.longitude;
            x.innerHTML="Latitude: " + position.coords.latitude + 
            "<br>Longitude: " + position.coords.longitude;
           // new initMap().addMarker({lat:lat,lng:longitude_1});
           console.log("Reached here maps");
         /*  var marker = new google.maps.Marker({position:{lat:lat,lng:longitude_1},                              /////       Add values here 
            map:map});
            var marker = new google.maps.Marker({position:{lat:12.931070,lng:77.560558},                        /////        Add values here
            map:map});*/
            console.log(<?php echo $row['start_loclat']?>);

       /*  var marker = new google.maps.Marker({position:{lat:<?php echo $row['start_loclat']?>,lng:<?php echo $row['start_loclong']?>},                              /////       Add values here 
            map:map});*/
            var marker = new google.maps.Marker({position:{lat:<?php echo $cust_start?>,lng:<?php echo $cust_start2?>},                              /////       Add values here 
            map:map});
            var marker = new google.maps.Marker({position:{lat:<?php echo  $cust_location?>,lng:<?php echo $cust_location2  ?>},                        /////        Add values here
            map:map});
            var marker = new google.maps.Marker({position:{lat:<?php echo $cust_start+0.0010?>,lng:<?php echo $cust_start2+0.0010?>},  
            icon: {
      url: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png"
    },                            /////       Add values here 
            map:map});
            var marker = new google.maps.Marker({position:{lat:<?php echo $cust_location?>,lng:<?php echo $cust_location2?>},     
            icon: {
      url: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png"
    },                         /////       Add values here 
            map:map});
        }
        </script>
        <div id="result"></div>
        <div id="map"></div>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script>
                /*axios.get("https://maps.googleapis.com/maps/api/geocode/json",
                {
                    location:'Bangalore',
                    key:"AIzaSyBsZe9HkLYb4iKEYP_PzwSTSnsC7qp0WG8"
                }).then(function(response){alert(response);});*/
            // Markers on Map
          function initMap() {
            console.log("Map starts here");
            map = new google.maps.Map(document.getElementById('map'), {
              center: {lat: 12.966297599999999, lng: 77.5749632},
              center: {lat: 12.966297599999999, lng: 77.5749632},
              zoom: 14
            });
            var lat=0;
            var longitude_1 = 0;
          /*  var marker = new google.maps.Marker({position:{lat:34.397,lng:150.644},
            var marker2 = new google.maps.Marker({ position:{lat:100,lng:300},
            map:map});*/
          var x = document.getElementById("demo");
        
        function getLocation() {
            
          if (navigator.geolocation) {
            navigator.geolocation.watchPosition(showPosition);
          } else { 
            x.innerHTML = "Geolocation is not supported by this browser.";
          }
        }
     /*   this.addMarker = function(coords)
          {
              console.log("The control reached here");
            
          }*/
        function showPosition(position) {
      //    console.log("Reached Here");
            lat = position.coords.latitude;
            longitude_1 =position.coords.longitude;
            console.log(lat.toString);
            console.log("this si a message");
            addMarker({lat:lat.toPrecision(5),lng:longitude_1.toPrecision(5)});
           /* console.log(lat+longitude_1);
            x.innerHTML="Latitude: " + position.coords.latitude + 
            "<br>Longitude: " + position.coords.longitude;*/
            
            
        }
          
         // addMarker({lat:34,lng:150});
        //  addMarker({lat:34.85,lng:150});
          }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBsZe9HkLYb4iKEYP_PzwSTSnsC7qp0WG8&callback=initMap"
        async defer>
    
    </script>
    <div class="container">
        <div class="row">
           <form action="cancel.php" method="post"> <button type="submit" class="btn btn-primary" style="margin-top: 20px;text-align: center;" id = "cancel" name = "submit">Cancel Trip</button></form>
        </div>
    <div>
        <p class="text" style="border: 10px;">Your Ride has arrived</p>                <!--                Visibility needs to be set using JavaScript      -->
    </div>
    </div>
    <div class="container-fluid">
    <div class="col-lg-8 col-md-6">
        <div class="single-footer-widget">
            <div class="widget-body" style="align-content: right;">

            </div>
        </div>
    </div>
    </div>
    <!-- Footer -->
    <div class ="container-fluid" style="
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    background-color: black;
    color: white;
    text-align: center;
  ">
   <div class="footer-copyright text-center py-3">© 2020 Copyright:
    <a href=""> carpool.com</a>
  </div>
  
   </div>
    </body>

</HTML>