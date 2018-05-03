<?php session_start(); ?>
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
	echo "{\"result\":[{\"count\":0, \"location\":\"" . $keyword . " is not in any posts\"}]}";
}
else {
	$i = 0;
	$result_str = "{\"result\":[";
	while($row = $result->fetch_assoc()) {
		if ($i > 0) {
			$result_str = $result_str . ",";
		}
		$result_str = $result_str . "{\"count\":" . $row["num_posts"] . ", \"location\":\"" . $row["location"] . "\"}";
		$i = $i + 1;
}
$result_str = $result_str . "]}";
echo $result_str;
}
?>
