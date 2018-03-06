<?php
$servername = $_POST("servername");
$dbusername = $_POST("dbusername");
$dbname = $_POST("dbname");
$password = $_POST("password");
$redirect_page = $_POST("redirect");

$conn = $conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) {
  echo "Failed to connect to database, try again later";
}

function Redirect($url, $statuscode = 200) {
  header("Location:" . $url, true, $statuscode);
  die();
}

$username = $_POST("username");
$userpass = $_POST("userpass");
$sql = "SELECT uid FROM user WHERE username = " . $username . "AND password = " . $password . ";";
if ($result->num_rows == 0) {
  // Redirect to login error page
  Redirect("login_failure.php");
}
else {
  // Rediect to correct page
  Redirect($redirect_page);
}?>
