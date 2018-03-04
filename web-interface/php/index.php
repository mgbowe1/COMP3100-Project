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
   <form>
     <input type="hidden" name="servername" value="<?php echo $servername; ?>">
     <input type="hidden" name="username" value="<?php echo $username; ?>">
     <input type="hidden" name="password" value="<?php echo $password; ?>">
     <input type="hidden" name="dbname" value="<?php echo $dbname; ?>">
     <label for="search">Search:</label>
     <input name="search" type="text">
     <label for="type">Type:</label>
     <select name="type">
       <option value="user">User</option>
       <option value="year">Year</option>
       <option value="keyword">Keyword</option>
     </select>
   </form>
  <a href="login.php">Login</a>
</body>
