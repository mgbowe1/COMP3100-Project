<?php session_start();
include("db_header.php");
$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error) {
  die("Failed to connect to the database in top_user_year.php");
}

$sql = "SELECT u1.username FROM USER u1, TWITTS t1 WHERE u1.uid = t1.uid AND year(post_time) = 2018 GROUP BY u1.uid ORDER BY COUNT(u1.uid) DESC, post_time ASC LIMIT 1";
$result = $conn->query($sql);

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    echo $row["username"] . "<br>";
  }
} else {
  echo "0 results";
}

header("Location: http://" . $servername . $serverroot . $_SESSION["last_page"]);

?>
