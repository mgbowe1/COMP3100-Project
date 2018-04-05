<?php session_start();
// include("db_header.php") is just an easy way to allow local settings
// configuration quickly by changing 1 file to update the whole application
include("db_header.php");
$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error) {
  die("Failed to connect to the database in follow.php");
}
// follow part of 8
$sql = "INSERT INTO follow (follower_id, following_id, follow_time) VALUES (" . $_SESSION["uid"] . ", " . $_POST["follow"] . ", NOW())";
$result = $conn->query($sql);
header("Location: http://" . $servername . $serverroot . $_SESSION["last_page"]);
?>
