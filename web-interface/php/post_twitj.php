<?php session_start();
// include("db_header.php") is just an easy way to allow local settings
// configuration quickly by changing 1 file to update the whole application
include("db_header.php");

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) {
  die("Connection to database failed. Failed to post twit");
}
$content = $_POST["content"];
$uid = $_POST["uid"];
$sql = "INSERT INTO twitts (tid, uid, body, post_time) VALUES (null, " . $uid . ", '" . $content . "', NOW())";
$result = $conn->query($sql);
if(!$result) {
  echo "{\"error\":\"Failed to post twit\"}";
}
else {
  echo "{\"success\":\"posted twit\"}";
}
?>
