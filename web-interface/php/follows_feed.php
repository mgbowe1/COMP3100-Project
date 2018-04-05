<?php session_start(); ?>
<!DOCTYPE html>
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
$_SESSION["last_page"] = "follows_feed.php";
$sql = "SELECT body, post_time, tid, twitts.uid as uid, user.username as name FROM twitts, user WHERE twitts.uid = user.uid AND twitts.uid IN (SELECT following_id FROM follow WHERE follower_id ='". $_SESSION["uid"] . "') ORDER BY `post_time` DESC";
$result = $conn->query($sql);
?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <title><?php echo $_SESSION["username"]; ?> feed</title>
</head>
<body>
  <div class="container">
  <?php
  include("banner.php");
  if($conn_failure) {
    echo "could not connect to database";
  }
  else if($result->num_rows == 0) {
  }
  else {
    while($row = $result->fetch_assoc()) {
      $sql2 = "SELECT user.username AS name, comment.body AS body, comment.comment_time AS time, user.uid AS uid, comment.cid AS cid FROM comment, user WHERE user.uid = comment.uid AND comment.tid = " . $row["tid"] . " ORDER BY comment.comment_time DESC";
      $result2 = $conn->query($sql2);
      echo "<div class=\"post row\"><div class=\"col-12\"><div class=\"row\"><div class=\"col\"></div><div class=\"col-10 post-inside\"><h3>" . $row["name"] . "</h3></div><div class=\"col\"></div></div></div>";
      echo "<div class=\"col-12\"><div class=\"row\"><div class=\"col\"></div><div class=\"col-10 post-inside\"><p class=\"tline\">posted at<span class=\"time\" data-time=\"" . $row["post_time"] . "\"> " . $row["post_time"] . "</span></p></div><div class=\"col\"></div></div></div>";
      echo "<div class=\"col-12\"><div class=\"row\"><div class=\"col\"></div><div class=\"col-10 post-inside\"><p class=\"postcontent\">" . $row["body"] . "</p></div><div class=\"col\"></div></div></div>";
      if($result2->num_rows >= 1) {
        while($row2 = $result2->fetch_assoc()) {
          echo "<div class=\"col-12\"><div class=\"row\"><div class=\"col\"></div><div class=\"col-10 comment post-inside\"><div class=\"row\"><div class=\"col-8 offset-2 comment-inside\"><h4>" . $row2["name"] . "</h4></div></div>";
          echo "<div class=\"row\"><div class=\"col-8 offset-2 comment-inside\"><p class=\"comment_content\">" . $row2["body"] . "</p></div></div>";
          echo "<div class=\"row\"><div class=\"col-8 offset-2 comment-inside\"><p class=\"tline\">at <span class=\"time\" data-time=\"" . $row2["time"] . "\"> " . $row2["time"] . "</span></p></div></div>";
          if($_SESSION["logged_in"] && ($_SESSION["uid"] == $row["uid"])) {
            echo "<div class=\"row\"><div class=\"col-8 offset-2 comment-inside\"><a href=\"http://" . $servername . $serverroot . "delete_comment.php?cid=" . $row2["cid"] . "\">delete</a></div></div>";
          }
          echo "</div><div class=\"col\"></div></div></div>";
        }
      }
      if($_SESSION["logged_in"]) {
        echo "<div class=\"col-12\"><div class=\"row\">";
        echo "<div class=\"col\"></div><div class=\"col-10 comment post_inside\"><div class=\"row\"><div class=\"col-8 offset-2 comment-inside\">";
        echo "<form action=\"post_comment.php\" method=\"post\">";
        echo "<input type=\"hidden\" name=\"tid\" value=\"" . $row["tid"] . "\">";
        echo "<label for=\"comment_content\">";
        echo "<input name=\"comment_content\" type=\"text\">";
        echo "<input type=\"submit\" value=\"Comment\"></form>";
        echo "</div></div></div><div clas=\"col\"></div></div></div>";
      }
      echo "</div>";
    }
  }
?>
</div>
</body>
</html>
