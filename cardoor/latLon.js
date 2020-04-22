function get_latlong()
{
  var srclat;
  var srclong;
  var destlat ;
  var destlong;
  sourceAddress=document.getElementById("sourceAddress").value;
  console.log(sourceAddress);
  axios.get("https://maps.googleapis.com/maps/api/geocode/json",{
    params:{
      address:sourceAddress,
      key:"AIzaSyBsZe9HkLYb4iKEYP_PzwSTSnsC7qp0WG8"
    }
  }).then(function(response)
  {
   // var jsonObj=JSON.parse(response);
   console.log(response.data);
    console.log(typeof(response)); 
     srclat = response.data.results[0].geometry.location.lat;
     srclong = response.data.results[0].geometry.location.lng;
    //var latitudeinformation = response.data.results[0].geometry.location.lat+" "+response.data.results[0].geometry.location.lng;
   // console.log("We reached till here");

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
   //  console.log("We reached till here");
    var latitudeinformation = response.data.results[0].geometry.location.lat+" "+response.data.results[0].geometry.location.lng;
   // console.log(response["results"]["geometry"]["location"]["lng"]);
   var data={
    srclat : srclat,
    srclong: srclong,
    destlat: destlat,
    destlong: destlong 
  };
  console.log(data);
   $.post('driver_page.php',data,function (val)
   {
       console.log(val);
    });
    $.post('get_cust.php',data,function (value)
   {
    document.getElementById("result").innerHTML="<br><br><br>"+"<h1>"+value+"<h1>";
    });
   console.log("Php line is executed");
  })
  .catch(function(error)
  {
    console.log(error);
  });
  
//  $.post("driver_page.php",data);
  console.log("Reached here"+destlat);
  console.log(srclat);
 // callPHP(data);

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