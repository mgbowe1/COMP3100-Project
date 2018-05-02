<?php
session_start();
function Redirect($url, $statuscode = 200) {
  header("Location: " . $url);
}
// include("db_header.php") is just an easy way to allow local settings
// configuration quickly by changing 1 file to update the whole application
include("db_header.php");

$conn = $conn = new mysqli($servername, $username, $password, $dbname);

$uname = $_POST["username"];
$upass = $_POST["password"];

$sql = "SELECT uid FROM user WHERE username = '" . $uname . "' AND password = '" . $upass . "'";
$result = $conn->query($sql);

  // Rediect to correct page
  
  // <!-- Display Results -->
if($conn->connect_error) {
  echo "{\"error\":\"could not connect to database\"}";
}
else if($result->num_rows < 1) {
  $result_str = "{\"status\":\"failure\",
                  \"username\":\"null\",
                  \"uid\":\"null\"
                }";
}
else {
  $_SESSION["logged_in"] = true;
  $_SESSION["username"] = $uname;
  $row = $result->fetch_assoc();
  $_SESSION["uid"] = $row["uid"];

  $result_str = "{\"status\":\"success\",
                  \"username\":".$uname.",
                  \"uid\":".$row["uid"]."
                }";
}
echo $result_str;
?>
