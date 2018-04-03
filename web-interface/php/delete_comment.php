<?php session_start();
// include("db_header.php") is just an easy way to allow local settings
// configuration quickly by changing 1 file to update the whole application
include("db_header.php");

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error) {
  die("Connection to database failed. Failed to delete comment");
}
$comment = $_GET["cid"];

$sql = "DELETE FROM comment WHERE cid = " . $comment;
$result = $conn->query($sql);
header("Location: http://" . $servername . $serverroot . $_SESSION["last_page"]);
?>
