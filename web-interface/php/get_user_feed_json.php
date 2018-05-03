<?php session_start(); ?>

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

// query 3
$tu_name = $_POST["search"];
$sql = "SELECT body, post_time, tid, uid FROM twitts WHERE uid IN (SELECT uid FROM user WHERE username ='". $tu_name . "') ORDER BY `post_time` DESC";
$result = $conn->query($sql);

if($conn_failure) {
  echo "{\"error\":\"could not connect to database\"}";
}
else if($result->num_rows == 0) {
  $sql2 = "SELECT uid FROM user WHERE username = '" . $tu_name . "'";
  $result2 = $conn->query($sql2);
  if($result2->num_rows < 1) {
    echo "{\"error\":\"There is nobody with username, " . $tu_name . ", on Twitter\"}";
  }
  else {
      echo "{\"result\":\"" . $tu_name . " has not made any posts\"}";
  }
}
else {
  $result_str = "{\"result\":[";
  $tot_num_rows = $result->num_rows;
  for($i = 0; $i < $tot_num_rows; $i++) {
    $row = $result->fetch_assoc();
    $sql2 = "SELECT user.username AS name, comment.body AS body, comment.comment_time AS time, user.uid AS uid, comment.cid AS cid FROM comment, user WHERE user.uid = comment.uid AND comment.tid = " . $row["tid"] . " ORDER BY comment.comment_time DESC";
    $result2 = $conn->query($sql2);
    if($i > 0) {
      $result_str = $result_str . ", ";
    }
    $result_str = $result_str . "{\"tid\":" . $row["tid"]
                             . ", \"body\":\"" . $row["body"]
                             . "\", \"time\":\"" . $row["post_time"] 
                             . "\", \"uid\":" . $row["uid"] 
                             . ", \"name\":\"" . $tu_name 
                             . "\", \"comments\":[";
    if($result2->num_rows >= 1) {
      $num_rows2 = $result2->num_rows;
      for($i = 0; $i < $num_rows2; $i++) {
        $row2 = $result2->fetch_assoc();
        if($i > 0) {
          $result_str = $result_str . ", ";
        }
        $result_str = $result_str . "{\"name\":\"" . $row2["name"]  .
          "\", \"body\":\"" . $row2["body"] .
          "\", \"time\":\"" . $row2["time"] .
          "\", \"uid\":" . $row2["uid"] .
          ", \"cid\":" . $row2["cid"] . "}";
      }
    }
    $result_str = $result_str . "]}";
  }
  $result_str = $result_str . "]}";
  echo $result_str;
}
?>