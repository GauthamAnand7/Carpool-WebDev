<?php
require "connection.php";
?> 
<?php
 if(isset($_POST['login_button']))
{
  $username= $_POST['username'];
  $password = $_POST['password'];
 // echo "$username";
  $insert_username = "SELECT id from user_table where name = '$username' and password = '$password' and type = 'driver'";
  $result = $conn->query($insert_username);
  if($result->num_rows > 0){
        $row =$result->fetch_assoc();
          session_start();
          $_SESSION['user'] = $username;
          $_SESSION['pwd'] = $password;
          $_SESSION['id'] = $row["id"];
           
      header("Location:driver dashboard.html");
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
