<?php 
require "connection.php";
function sanitize_my_email($field) {
    $field = filter_var($field, FILTER_SANITIZE_EMAIL);
    if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}
if(isset($_POST['Submit']))
{
  $username= $_POST['username'];
  echo '$username';
  
      $verify = "SELECT email from user_table where name = '$username'";
      $get_password = "SELECT password from user_table where name = '$username'";
      $result = mysqli_query($conn,$verify);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

      $active = $row['active'];
      $count = mysqli_num_rows($result);
      $password = $conn->query($get_password);
      if($count == 0) {
        // session_register("myusername");
        // $_SESSION['login_user'] = $myusername;
        
	    header("Location:login.html");
	    $to_email = $verify;
	    $subject = 'Password';
	    $message = "Your password has been requested $password";
	    $headers = 'From: noreply @ company. com';
	    //check if the email address is invalid $secure_check
	    $secure_check = sanitize_my_email($to_email);
	    if ($secure_check == false) 
            {
		echo "Invalid input";
	    } 
            else
             { //send email 
		mail($to_email, $subject, $message, $headers);
		echo "This email is sent using PHP Mail";
	     }
		 exit();
      }
      else {
           $error = "Your Login Name is invalid";
           echo $error;
           }
}
else
{
  echo'<h1> Button Not pressed <h1>';
}
?>
