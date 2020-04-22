<?php
require "connection.php";
?> 
<?php
  $username = $_POST['uname'];
  $password = $_POST['pwd'];
  $email    = $_POST['email'];
  $mobile   = $_POST['mobile'];
  $address  = $_POST['address'];
  $lnum     = $_POST['lnum'];
  $vnum     = $_POST['vnum'];
 // echo "$username";
 
                    $insert = $conn->query("INSERT INTO user_table (name , password , license_number,car_no , address,license,email , phone,type ) values ('$username','$password','".$fileName."','$vnum','$address','$lnum','$email','$mobile','customer')");
                    $insert2 = $conn->query("INSERT INTO login_table (name,password,type) values ('$username','$password','customer');");
                  //  $numberOfRows = mysqli_num_rows($result['active']);

                    
                        if($insert && $insert2){
                                $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
                                header("Location:index.html");
                                exit();
                            }
                        else{
                            $statusMsg = "File upload failed, please try again.";
                         //   echo "Error <br>";
                           // echo "<h1>$numberOfRows <h1>";
                        } 
       

// Display status message
echo $statusMsg;
?>