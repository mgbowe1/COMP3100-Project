<?php session_start();
// include("db_header.php") is just an easy way to allow local settings
// configuration quickly by changing 1 file to update the whole application
include("db_header.php");

$conn = new mysqli($servername, $username, $password, $dbname);

$content = mysqli_real_escape_string($conn, $_POST["content"]);
$uid = $_POST["uid"];
$tid = $_POST["tid"];

$sql = "INSERT INTO comment (cid, tid, uid, body, comment_time) VALUES (null, " . $tid . ", " . $uid . ", '" . $content . "', NOW())";
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
