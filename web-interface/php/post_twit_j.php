<?php session_start();
// include("db_header.php") is just an easy way to allow local settings
// configuration quickly by changing 1 file to update the whole application
include("db_header.php");

$conn = new mysqli($servername, $username, $password, $dbname);

$content = $_POST["content"];
$uid = $_POST["uid"];

$sql = "INSERT INTO twitts (tid, uid, body, post_time) VALUES (null, " . $uid . ", '" . $content . "', NOW())";
$result = $conn->query($sql);

if($conn->connect_error) {
	echo "{\"error\":\"could not connect to database\"}";
}
if(!$result) {
  	echo "post failed";
}
else {
	echo "post successful";
}
?>
