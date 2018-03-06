<!DOCTYPE html>
<?php
$servername = $_POST["servername"];
$username = $_POST["username"];
$password = $_POST["password"];
$dbname = $_POST["dbname"];

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) {
  $conn_failure = true;
}
else {
  $conn_failure = false;
}
$tu_name = $_POST("search");
$sql = "SELECT body, post_time FROM twitts WHERE uid IN (SELECT uid FROM user WHERE username =". $tu_name . ")";
$result = $conn->query($sql);
?>
<head>
  <title><?php echo $_POST("search"); ?> feed</title>
</head>
<body>
  <?php if($conn_failure) {
    echo "could not connect to database";
  }
  else if(!$result) {
    echo "<p>Your search returned 0 results, check if the user exists.</p>";
  }
  else {
    while($row = $result->fetch_assoc()) {
      echo "<div class=\"post\"><h3>" . $tu_name . "</h3>";
      echo "<p class=\"tline\">posted at<span class=\"time\">" . $row["post_time"] . "</span></p>";
      echo "<p class=\"postcontent\">" . $row["body"] . "</p></div>"
    }
  }

</body>
