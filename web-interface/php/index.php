<!DOCTYPE html>
<?php include("db_header.php"); ?>
<head>
  <title>Twitter - HOME</title>
</head>
<body>
  <h1>Welcome to Twitter</h1>
  <?php
  $conn = new mysqli($servername, $username, $password);
  if($conn->connect_error) {
    die("Connection Failed");
  }
  echo "<p>Connected to server</p>";
   ?>
   <form>
     <label for="search">Search:</label>
     <input name="search" type="text">
     <label for="type">Type:</label>
     <select name="type">
       <option value="user">User</option>
       <option value="year">Year</option>
       <option value="keyword">Keyword</option>
     </select>
   </form>
   <form>
     <input
   </form>
  <a href="login.php">Login</a>
</body>
