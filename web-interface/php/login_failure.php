<!-- include("db_header.php") is just an easy way to allow local settings
    configuration quickly by changing 1 file to update the whole application -->
<?php
session_start();
include("db_header.php");
 ?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <title>Incorrect Username/Password</title>
</head>
<body>
  <div class="container">
    <h3 class="error">Incorrect Username and/or Password. Please try again</h3>
    <form action="login.php" method="POST">
      <label for="username">Username: </label>
      <input type="text" name="username"><br />
      <label for="password">Password: </label>
      <input type="text" name="password"><br />
      <input type="submit" value="Log In">
    </form>
  </div>
</body>
