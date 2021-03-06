<?php session_start(); ?>
<!DOCTYPE html>

<!-- 3) Count the number of posts that contains the keyword “flu”, display the location of the users who have made the posts as well (use “GROUP BY location”). - Grouped by location, Sorted by number of posts -->
<?php
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
$keyword = $_GET["search"];
$_SESSION["last_page"] = "keyword_search?search=" . $keyword;

$like_clause = "(body LIKE '% " . $keyword . "' OR body LIKE '% " . $keyword . ".%' OR body LIKE '% " . $keyword . "!%' OR body LIKE '% " . $keyword . ",%' OR body LIKE '% " . $keyword . "?%' OR body LIKE '% " . $keyword . " %')";
$sql = "SELECT COUNT(*) AS num_posts, user.location AS location FROM twitts, user WHERE twitts.uid = user.uid AND " . $like_clause . " GROUP BY user.location ORDER BY num_posts DESC";
$result = $conn->query($sql);
?>

<!-- Display Results -->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <title><?php echo $_POST["search"]; ?> results</title>
</head>
<body>
  <div class="container">
  <?php
  include("banner.php");
  if($conn_failure) {
    echo "could not connect to database";
  }
  else if($result->num_rows < 1) {
    echo "<p>Your search returned 0 results.</p>";
  }
  else {
    while($row = $result->fetch_assoc()) {
      echo "<div class=\"aggregation row\"><div class=\"col-sm\">" . $row["location"] . "</div> <div class=\"col-sm\"> " . $row["num_posts"] . "</div></div>";
    }
  }
?>
  </div>
</body>
