<!DOCTYPE html>
<head>
  <title>Twitter - HOME</title>
</head>
<body>
  <?php
  // These are the settings for github. Adjust as needed locally
  $servername = "localhost";
  $username = "username";
  $password = "password";
  $dbname = "comp3100"; //Change this to the name of your loacl database
   ?>
  <h1>Welcome to Twitter</h1>
  <?php
  $conn = new mysqli($servername, $username, $password);
  if($conn->connect_error) {
    die("Connection Failed");
  }
  echo "<p>Connected to server</p>";
   ?>
  <a href="Login.php">Login</a>
</body>
