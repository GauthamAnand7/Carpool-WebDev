 <?php
require "connection.php";
?> 
<?php
        session_start();

 if(isset($_POST['login_button']))
{
  $username= $_POST['username'];
  $password = $_POST['password'];
 // echo "$username";
  $insert_username = "SELECT * from login_table where name = '$username' and password = '$password'";
  $insert2 = "SELECT * from user_table where name = '$username' and password = '$password'";
$result = mysqli_query($conn,$insert_username);
$result2 = $conn->query($insert2);

      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $row2 =$result2->fetch_assoc();

      $active = $row['active'];
      $count = mysqli_num_rows($result);
      
      printf("%d",$count);
		
      if($count == 1 && $result2) {
        $_SESSION['login_user'] = $username;
        $_SESSION['id'] = $row2["id"];
        // session_register("myusername");
        // $_SESSION['login_user'] = $myusername;
        echo "<h1>"+ $_SESSION['id']+ "</h1>";
         
    header("Location:customer_page.html");
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
