<?php
session_start();
function Redirect($url, $statuscode = 200) {
  header("Location: " . $url);
}
include("db_header.php");

$conn = $conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) {
  echo "Failed to connect to database, try again later";
}

$uname = $_POST["username"];
$upass = $_POST["password"];
if ($upass == "") {
  Redirect("https://" . $servername . $serverroot);
}
$redirect_page = $_SESSION["last_page"];
$sql = "SELECT uid FROM user WHERE username = '" . $uname . "' AND password = '" . $upass . "'";
//echo $sql;
$result = $conn->query($sql);
if ($result->num_rows < 1) {
  // echo $result . "login failed";
  // Redirect to login error page
  Redirect("login_failure.php");
}
else {
  $_SESSION["logged_in"] = true;
  $_SESSION["username"] = $uname;
  $row = $result->fetch_assoc();
  $_SESSION["uid"] = $row["uid"];
  // Rediect to correct page
  Redirect("http://" . $servername . $serverroot . $redirect_page);
}?>
