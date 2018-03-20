<?php
function Redirect($url, $statuscode = 200) {
  header("Location:" . $url, true, $statuscode);
  exit();
}
include("db_header");

$conn = $conn = new mysqli($servername, $dbusername, $password, $dbname);
if($conn->connect_error) {
  echo "Failed to connect to database, try again later";
}

$uname = $_POST["username"];
$upass = $_POST["userpass"];
$sql = "SELECT uid FROM user WHERE username = " . $uname . "AND password = " . $upass . ";";
$result = $conn->query($sql);
if (!$result) {
  // Redirect to login error page
  Redirect("login_failure.php");
}
else {
  // Rediect to correct page
  Redirect($redirect_page);
}?>
