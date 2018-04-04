<div class="jumbotron page_header">
  <div class="row">

    <div class="col-sm">
      <a href="index.php">
        <h1>Twitter</h1>
      </a>
    </div>
    <div class="col-sm">
    </div>
    <div class="col-sm">
      <?php if($_SESSION["logged_in"] == false): ?>
        <form method="post" action="login.php">
          <label for="username">Username:</label>
          <input type="text" name="username"><br />
          <label for="password">Password:</label>
          <input type="text" name="password"><br />
          <input type="submit" value="Log In"></form>
      <?php else: ?>
        <p><span> <?php echo $_SESSION["username"] ?> </span> | <a href="logout.php">Log out</a></p>
      <?php endif; ?>
    </div>
  </div>
</div>
