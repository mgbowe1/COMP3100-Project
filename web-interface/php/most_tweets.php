<?php session_start(); ?>
<!DOCTYPE html>
<?php include("db_header.php");

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) {
  $conn_failure = true;
}
else {
  $conn_failure = false;
}
$_SESSION["last_page"] = "most_tweets.php?year=" . $_GET["year"];
$ty_year = $_GET["year"];

$sql = "SELECT u1.username, COUNT(*) as number_of_tweets, year(post_time) as year FROM USER u1, TWITTS t1 WHERE u1.uid = t1.uid AND year(post_time) = '". $ty_year . "' GROUP BY u1.uid ORDER BY COUNT(u1.uid) DESC, post_time ASC LIMIT 1";
$result = $conn->query($sql);
?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <title><?php echo $_GET["year"]; ?> most tweets</title>
</head>
<body>
  <div class="container">
  <?php
  include("banner.php");
  if($conn_failure) {
    echo "could not connect to database";
  }
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<div class=\"post row\"><div class=\"col-12 post-inside\"><h2> Most Active User of " . $row["year"] . "</h2></div>";
      echo "<div class=\"col-12 post-inside\"><h3>" . $row["username"] . " with " . $row["number_of_tweets"] . " post(s). </h3></div><div class=\"col post-inside\"></div>";
      echo "</div>";
    }
  } else {
    echo "<div class=\"post row\"><div class=\"col-12 post-inside\"><h2> No Users Posted in " . $ty_year . "</h2></div>";
    echo "</div>";
}
  ?>
</div>
</body>
</html>