<?php
require "connection.php";
?> 
<?php
$targetDir = "uploads/";
$fileName = basename($_FILES["limg"]['name']);
$tmp = dirname(__FILE__) . "/uploads/" . $fileName;
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
 if(isset($_POST['loginButton']) || !empty($_FILES["limg"]["name"]))
{
  $username = $_POST['uname'];
  $password = $_POST['pwd'];
  $email    = $_POST['email'];
  $mobile   = $_POST['mobile'];
  $address  = $_POST['address'];
  $lnum     = $_POST['lnum'];
  $vnum     = $_POST['vnum'];
 // echo "$username";
 $allowTypes = array('jpg','png','jpeg','gif','pdf');
 if(in_array($fileType, $allowTypes))
   {
    // Upload file to server ( Where is this server??)
        if(move_uploaded_file($_FILES["limg"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
                    $insert = $conn->query("INSERT INTO user_table (name , password , license_number,car_no , address,license,email , phone,type ) values ('$username','$password','".$fileName."','$vnum','$address','$lnum','$email','$mobile','driver')");
                    $insert2 = $conn->query("INSERT INTO login_table (name,password,type) values ('$username','$password','driver');");
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
        }
        else{
            echo $_FILES["limg"]["name"]."<br>";
            echo $targetFilePath."<br>";
            echo $_FILES["limg"]["tmp_name"]."<br>";
                $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
        }
   }
   else{
       echo $targetFilePath;
       echo $allowTypes;
       $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
        $statusMsg = 'Please select a file to upload.';
        }
}
else {
    $statusMsg = "Please upload license copy";
}

// Display status message
echo $statusMsg;
?>