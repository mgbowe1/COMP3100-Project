<?php session_start();
if(!isset($_SESSION["logged_in"])) {
  $_SESSION["logged_in"] = false;
}?>
<!DOCTYPE html>
<?php $_SESSION["last_page"] = "index.php"; ?>
<?php include("db_header.php"); ?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <title>Twitter - HOME</title>
</head>
<body>
  <div class="container">
  <?php
    include("banner.php");
    $conn = new mysqli($servername, $username, $password);
    if($conn->connect_error) {
      die("Connection Failed");
    }
  ?>

  <!-- 1) Find the post that has the most number of likes - Sorted by Count, and then by Date to get the first post that achieved that many likes -->
    <?php
      $conn = new mysqli($servername, $username, $password, $dbname);
      $sql = "SELECT body, t1.uid as uid, u1.username as username, t1.post_time as post_time, COUNT(t1.uid) as likes FROM twitts t1, thumb l1, user u1 WHERE t1.uid = u1.uid AND t1.tid = l1.tid GROUP BY t1.tid ORDER BY COUNT(t1.tid) DESC, t1.post_time ASC LIMIT 1";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<div class=\"post row\"><div class=\"col-12 post-inside\"><h2> Top Post - (" . $row["likes"] . ") like(s)</h2></div>";
          echo "<div class=\"col-10 post-inside\"><h3>" . $row["username"] . "</h3></div><div class=\"col post-inside\"></div>";
          echo "<div class=\"col post-inside\"></div><div class=\"col-10 offest post-inside\"><p class=\"tline\">posted at<span class=\"time\" data-time=\"" . $row["post_time"] . "\"> " . $row["post_time"] . "</span></p></div><div class=\"col post-inside\"></div>";
          echo "<div class=\"col post-inside\"></div><div class=\"col-10 offest post-inside\"><p class=\"postcontent\">" . $row["body"] . "</p></div><div class=\"col post-inside\"></div>";
          echo "</div>";
        }
      } else {
        echo "no posts with likes found.";
      }
    ?>

  <!-- 2) Find the person who has the most number of followers - Sorted by Count, and then by Date to get the first user to achieve that many followers -->
    <?php
      $conn = new mysqli($servername, $username, $password, $dbname);
      $sql = "SELECT u1.username, COUNT(u1.uid) as followers FROM user u1, follow f1 WHERE u1.uid = f1.following_id GROUP BY u1.uid ORDER BY COUNT(u1.uid) DESC, follow_time ASC LIMIT 1";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<div class=\"post row\"><div class=\"col-12 post-inside\"><h2> Most Popular User - (" . $row["followers"] . ") follower(s)</h2></div>";
          echo "<div class=\"col-12 post-inside\"><h3>" . $row["username"] . "</h3></div><div class=\"col post-inside\"></div>";
          echo "</div>";
        }
      } else {
        echo "No user with followers found.";
      }
    ?>

  <!-- Forms for queries 3), 4), 5) -->
    <form method="get" action="get_user_feed.php">
      <label for="search">User:</label>
      <input name="search" type="text">
      <input type="submit" value="User Search">
    </form>
    <form method="get" action="keyword_search.php">
      <label for="search">Keyword:</label>
      <input name="search" type="text">
      <input type="submit" value="Keyword Search">
    </form>
    <form method="get" action="most_tweets.php">
      <label for="search">Top User By Year:</label>
      <input name="year" type="text" pattern="[0-9]{4,4}">
      <input type="submit" value="Year Search">
    </form>

  <!-- Conditionally show forms for queries requiring login - queries 6) - 10) -->
    <?php if($_SESSION["logged_in"] == true): ?>

  <!-- 7) After log in, user posts a new twit -->
    <form method="post" action="post_twit.php">
      <label for="content">Twit: </label><br />
      <input type="textarea" name="content"><br />
      <input type="submit" value="Post Twit">
    </form>

  <!-- 8) After log in, user follows/unfollows another user -->
    <form method="post" action="follow.php">
      <label for="follow">Follow</label>
      <select name="follow">
        <?php
          $conn = new mysqli($servername, $username, $password, $dbname);
          $sql = "SELECT * from user where uid NOT IN (SELECT following_id FROM follow WHERE follower_id = " . $_SESSION["uid"] . ")";
          $result = $conn->query($sql);
          while ($row = $result->fetch_assoc()) {
            echo "<option value=\"" . $row["uid"] . "\">" . $row["username"] . "</option>";
          }
        ?>
    </select>
    <input type="submit" value="Follow">
    </form>
    <form method="post" action="unfollow.php">
      <label for="unfollow">Unfollow</label>
      <select name="unfollow">
      <?php
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql = "SELECT * from user where uid IN (SELECT following_id FROM follow WHERE follower_id = " . $_SESSION["uid"] . ")";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
          echo "<option value=\"" . $row["uid"] . "\">" . $row["username"] . "</option>";
        }
      ?>
    </select>
    <input type="submit" value="Unfollow">
    </form>

  <!-- 6) After log in, find all the senders of messages to the user -->
    <?php
      $conn = new mysqli($servername, $username, $password, $dbname);
      $sql = "SELECT u2.username as username, COUNT(*) as number_of_messages FROM user u2, message m2 WHERE u2.uid = m2.sender_id and m2.message_id in (SELECT m1.message_id FROM user u1, message m1 WHERE u1.uid = m1.receiver_id AND u1.uid = " . $_SESSION["uid"] . ") ORDER BY 'send_time' DESC";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        echo "<h4>Message(s) from: <br></h4>";
        while ($row = $result->fetch_assoc()) {
          if($row["number_of_messages"] == 0) {
            echo "<p>You have 0 Messages</p>";
          }
          else {
            echo "<p>(" . $row["number_of_messages"] . ") " . $row["username"] . "</p>";
          }
        }
      } else {
        echo "<h4>You have 0 Messages</h4>";
      }
    ?>
    <a href="follows_feed.php">Posts from people I follow</a>
  <?php endif; ?>
</div>
</body>
