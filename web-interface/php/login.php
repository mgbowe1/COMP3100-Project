<?php
function Redirect($url, $statuscode = 200) {
  header("Location:" . $url, true, $statuscode);
  exit();
}
$servername = $_POST["servername"];
$dbusername = $_POST["dbusername"];
$dbname = $_POST["dbname"];
$password = $_POST["password"];
$redirect_page = $_POST["redirect"];

$conn = $conn = new mysqli($servername, $dbusername, $password, $dbname);
if($conn->connect_error) {
  echo "Failed to connect to database, try again later";
}

$username = $_POST["username"];
$userpass = $_POST["userpass"];
$sql = "SELECT uid FROM user WHERE username = " . $username . "AND password = " . $password . ";";
$result = $conn->query($sql);
if (!$result) {
  // Redirect to login error page
  Redirect("login_failure.php");
}
else {
  // Rediect to correct page
  Redirect($redirect_page);
}?>
