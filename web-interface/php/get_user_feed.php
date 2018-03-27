<?php session_start(); ?>
<!DOCTYPE html>
<?php
include("db_header.php");

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) {
  $conn_failure = true;
}
else {
  $conn_failure = false;
}
$_SESSION["last_page"] = "get_user_feed.php?search=" . $_GET["search"];
$tu_name = $_GET["search"];
$sql = "SELECT body, post_time, tid FROM twitts WHERE uid IN (SELECT uid FROM user WHERE username ='". $tu_name . "') ORDER BY `post_time` DESC";
$result = $conn->query($sql);
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <title><?php echo $_GET["search"]; ?> feed</title>
</head>
<body>
  <div class="container">
  <?php
  include("banner.php");
  if($conn_failure) {
    echo "could not connect to database";
  }
  else if($result->num_rows == 0) {
    $sql2 = "SELECT uid FROM user WHERE username = '" . $tu_name . "'";
    $result2 = $conn->query($sql2);
    if($result2->num_rows < 1) {
      echo "<div class=\"row\"><p>There is nobody with username, " . $tu_name . ", on Twitter</p></div>";
    }
    else {
        echo "<div class=\"row\"><p>" . $tu_name . " has not made any posts </p></div>";
    }
  }
  else {
    while($row = $result->fetch_assoc()) {
      $sql2 = "SELECT user.username AS name, comment.body AS body, comment.comment_time AS time, user.uid AS uid, comment.cid AS cid FROM comment, user WHERE user.uid = comment.uid AND comment.tid = " . $row["tid"] . " ORDER BY comment.comment_time DESC";
      $result2 = $conn->query($sql2);
      echo "<div class=\"post row\"><div class=\"col-10 offest-1 post-inside\"><h3>" . $tu_name . "</h3></div>";
      echo "<div class=\"col-10 offest-1 post-inside\"><p class=\"tline\">posted at<span class=\"time\" data-time=\"" . $row["post_time"] . "\"> " . $row["post_time"] . "</span></p></div>";
      echo "<div class=\"col-10 offest-1 post-inside\"><p class=\"postcontent\">" . $row["body"] . "</p></div>";
      if($result2->num_rows >= 1) {
        while($row2 = $result2->fetch_assoc()) {
          echo "<div class=\"col-12 comment post-inside\"><div class=\"row\"><div class=\"col-8 offset-2 comment-inside\"><h4>" . $row2["name"] . "</h4></div></div>";
          echo "<div class=\"row\"><div class=\"col-8 offset-2 comment-inside\"><p class=\"comment_content\">" . $row2["body"] . "</p></div></div>";
          echo "<div class=\"row\"><div class=\"col-8 offset-2 comment-inside\"><p class=\"tline\">at <span class=\"time\" data-time=\"" . $row2["time"] . "\"> " . $row2["time"] . "</span></p></div></div>";
          if($_SESSION["logged_in"] && ($_SESSION["uid"] == $row2["uid"])) {
            echo "<div class=\"row\"><div class=\"col-8 offset-2 comment-inside\"><a href=\"http://" . $servername . $serverroot . "delete_comment?cid= " . $row2["cid"] . "\">delete</a></div></div>";
          }
          echo "</div>";
        }
      }
      if($_SESSION["logged_in"]) {
        echo "<div class=\"col-12 comment post-inside\">";
        echo "<div class=\"row\"><div class=\"col-8 offset-2 comment-inside\">";
        echo "<form action=\"post_comment.php\" method=\"post\">";
        echo "<input type=\"hidden\" name=\"tid\" value=\"" . $row["tid"] . "\">";
        echo "<label for=\"comment_content\">";
        echo "<input name=\"comment_content\" type=\"text\">";
        echo "<input type=\"submit\" value=\"Comment\"></form>";
        echo "</div></div></div>";
      }
      echo "</div>";
    }
  }
?>
</div>
<script type="text/javascript">
function update_time() {
  document.querySelector(".time");
}
</script>
</body>
