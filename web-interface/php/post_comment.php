<?php session_start();
// include("db_header.php") is just an easy way to allow local settings
// configuration quickly by changing 1 file to update the whole application
include("db_header.php");

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error) {
  die("Connection to database failed. Failed to post twit");
}
$content = $_POST["comment_content"];
$sql = "INSERT INTO comment (cid, tid, uid, body, comment_time) VALUES (null, " . $_POST["tid"] . ", " . $_SESSION["uid"] . ", '" . $content . "', NOW())";
$result = $conn->query($sql);
header("Location: http://" . $servername . $serverroot . $_SESSION["last_page"]);
?>
