<?php
require "connection.php";
session_start();
?> 
<html>
    <body>
<?php 
$username = $_SESSION['user'];
$password = $_SESSION['pwd'];
  $insert_username = "SELECT id from user_table where name = '$username' and password = '$password' and type = 'driver'";
  $result = $conn->query($insert_username);
  $row =$result->fetch_assoc();
  $id = $row['id'];
  $result=$conn->query("Select * from cust_trips where DriverId = $id and stop_time is NULL");
  ?>
  <form action="select.php" method="post">
              <ul class="list-group" style="color: black;">
                <?php
              if ($result && $result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          $custid = $row['CustId'];
          $result2=$conn->query("Select * from user_table where id = $custid and type = 'customer'");
          $row2 =$result2->fetch_assoc();
          session_start();
          ?>
          
          <div>
          <li class="list-group-item"> <input type="submit" id="custid"  value="<?php echo $row2['name']." ph no:".$row2['phone']?>"></li>
          </div>
          <?php 
                    $_SESSION['id'] = $row['DriverId'];
          }
    } else {
        echo "0 results";
    }
     ?>
                        
                            </ul>
                            </form>
</body>
</html>