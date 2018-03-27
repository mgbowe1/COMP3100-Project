<?php session_start();
include("db_header.php");

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error) {
  die("Connection to database failed. Failed to post twit");
}
$content = $_POST["content"];
$sql = "INSERT INTO comment (cid, tid, uid, body, comment_time) VALUES (null, " . $_POST["tid"] ", " . $_SESSION["uid"] . ", '" . $content . "', NOW())";
$result = $conn->query($sql);
header("Location: http://" . $servername . $serverroot . "get_user_feed.php?search=" . $_SESSION["username"]);
?>
