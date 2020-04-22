 <?php
$servername = "localhost";
$username = "";
$password = "";
$database_name = "webdev";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$database_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
?> 
