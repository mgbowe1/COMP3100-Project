<?php
session_start();
function Redirect($url, $statuscode = 200) {
  header("Location: " . $url, true, $statuscode);
  exit();
}
include("db_header.php");

$conn = $conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) {
  echo "Failed to connect to database, try again later";
}

$uname = $_POST["username"];
$upass = $_POST["password"];
$sql = "SELECT uid FROM user WHERE username = " . $uname . "AND password = " . $upass . ";";
$result = $conn->query($sql);
if (!$result) {
  echo $result;
  // Redirect to login error page
  Redirect("login_failure.php");
}
else {
  echo $result;
  $_SESSION["logged_in"] = true;
  // Rediect to correct page
  Redirect($redirect_page);
}?>
