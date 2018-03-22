<!DOCTYPE html>
<?php
include("db_header.php");

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) {
  $conn_failure = true;
}
else {
  $conn_failure = false;
}
$tu_name = $_GET["search"];
$sql = "SELECT body, post_time FROM twitts WHERE uid IN (SELECT uid FROM user WHERE username ='". $tu_name . "')";
$result = $conn->query($sql);
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <title><?php echo $_POST["search"]; ?> feed</title>
</head>
<body>
  <div class="container">
  <?php
  include("banner.php");
  if($conn_failure) {
    echo "could not connect to database";
  }
  else if(!$result) {
    echo "<p>Your search returned 0 results, check if the user exists.</p>";
  }
  else {
    while($row = $result->fetch_assoc()) {
      echo "<div class=\"post\"><h3>" . $tu_name . "</h3>";
      echo "<p class=\"tline\">posted at<span class=\"time\"> " . $row["post_time"] . "</span></p>";
      echo "<p class=\"postcontent\">" . $row["body"] . "</p></div>";
    }
  }
?>
</div>
</body>
