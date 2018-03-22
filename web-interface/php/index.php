<?php session_start();
if(!isset($_SESSION["logged_in"])) {
  $_SESSION["logged_in"] = false;
}?>
<!DOCTYPE html>
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
 </div>
</body>
