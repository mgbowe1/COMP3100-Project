<?php session_start(); ?>
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
$sql = "SELECT body, post_time FROM twitts WHERE uid IN (SELECT uid FROM user WHERE username ='". $tu_name . "' ORDER BY post_time)";
$result = $conn->query($sql);
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <title><?php echo $_GET["search"]; ?> feed</title>
</head>
<body>
  <div class="container">
  <?php
  include("banner.php");
  if($conn_failure) {
    echo "could not connect to database";
  }
  else if($result->num_rows == 0) {
    $sql2 = "SELECT uid FROM user WHERE username = '" . $tu_name . "'";
    $result2 = $conn->query($sql2);
    if($result2->num_rows < 1) {
      echo "<div class=\"row\"><p>There is nobody with username, " . $tu_name . ", on Twitter</p></div>";
    }
    else {
        echo "<div class=\"row\"><p>" . $tu_name . " has not made any posts </p></div>";
    }
  }
  else {
    while($row = $result->fetch_assoc()) {
      echo "<div class=\"post row\"><div class=\"col-md\"><h3>" . $tu_name . "</h3>";
      echo "<p class=\"tline\">posted at<span class=\"time\" data-time=\"" . $row["post_time"] . "\"> " . $row["post_time"] . "</span></p>";
      echo "<p class=\"postcontent\">" . $row["body"] . "</p></div></div>";
    }
  }
?>
</div>
<script type="text/javascript">
function update_time() {
  document.querySelector(".time");
}
</script>
</body>
