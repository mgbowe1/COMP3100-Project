<?php session_start();
include("db_header.php");

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error) {
  die("Connection to database failed. Failed to delete comment");
}
$comment = $_GET["cid"];

$sql = "DELETE FROM comment WHERE cid = " . $comment;
$result = $conn->query($sql);
header("Location: http://" . $servername . $serverroot . $_SESSION["redirect_page"]);
?>
