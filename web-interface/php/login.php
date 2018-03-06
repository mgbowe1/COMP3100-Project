<?php
$servername = $_POST("servername");
$dbusername = $_POST("dbusername");
$dbname = $_POST("dbname");
$password = $_POST("password");

$conn = $conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) {
  echo "Failed to connect to database, try again later";
}

$username = $_POST("username");
$userpass = $_POST("userpass");
$sql = "SELECT uid FROM user WHERE username = " . $username . "AND password = " . $password . ";";
if ($result->num_rows == 0) {
  echo "Login Failed due to incorrect username or password";
}
else {
  // Rediect to correct page
}?>
