<?php session_start(); ?>
<!DOCTYPE html>
<?php
//<!-- 3) Count the number of posts that contains the keyword “flu”, display the location of the users who have made the posts as well (use “GROUP BY location”). - Grouped by location, Sorted by number of posts -->
// include("db_header.php") is just an easy way to allow local settings
// configuration quickly by changing 1 file to update the whole application

include("db_header.php");

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) {
  $conn_failure = true;
}
else {
  $conn_failure = false;
}

$keyword = $_POST["search"];
$like_clause = "(body LIKE '% " . $keyword . "' OR body LIKE '% " . $keyword . ".%' OR body LIKE '% " . $keyword . "!%' OR body LIKE '% " . $keyword . ",%' OR body LIKE '% " . $keyword . "?%' OR body LIKE '% " . $keyword . " %')";
$sql = "SELECT COUNT(*) AS num_posts, user.location AS location FROM twitts, user WHERE twitts.uid = user.uid AND " . $like_clause . " GROUP BY user.location ORDER BY num_posts DESC";
$result = $conn->query($sql);

// <!-- Display Results -->
if($conn_failure) {
	echo "{\"error\":\"could not connect to database\"}";
}
else if($result->num_rows < 1) {
	echo "{\"result\":\"" . $keyword . " is not in any posts\"}";
}
else {
	$result_str = "{\"result\":[";
	while($row = $result->fetch_assoc()) {
		$result_str = $result_str . "{\"count\":" . $row["num_posts"] . ", \"location\":\"" . $row["location"] . "]}";
	//echo "<div class=\"aggregation row\"><div class=\"col-sm\">" . $row["location"] . "</div> <div class=\"col-sm\"> " . $row["num_posts"] . "</div></div>";
}
	echo $result_str;
}
?>
