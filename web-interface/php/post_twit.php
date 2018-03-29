<?php session_start();
include("db_header.php");

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error) {
  die("Connection to database failed. Failed to post twit");
}
$content = $_POST["content"];
$sql = "INSERT INTO twitts (tid, uid, body, post_time) VALUES (null, " . $_SESSION["uid"] . ", '" . $content . "', NOW())";
$result = $conn->query($sql);
if(!$result) {
  header("Location: http://" . $servername . $serverroot);
}
header("Location: http://" . $servername . $serverroot . "get_user_feed.php?search=" . $_SESSION["username"]);
?>
