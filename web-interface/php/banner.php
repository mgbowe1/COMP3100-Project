<div class="jumbotron page_header">
  <div class="row">
    <div class="col-sm">
      <h1>Twitter</h1>
    </div>
    <div class="col-sm">
      <a href="#">Messages</a>
    </div>
    <div class="col-sm">
      <?php if($_SESSION["logged_in"] == false) {
        echo "<form method=\"post\" action=\"login.php\">";
        echo "<input type=\"hidden\" name=\"redirect_page\" value=\"index.php\">";
        echo "<label for=\"username\">Username:</label>";
        echo "<input type=\"text\" name=\"username\"><br />";
        echo "<label for=\"password\">Password:</label>";
        echo "<input type=\"text\" name=\"password\"><br />";
        echo "<input type=\"submit\" value=\"Log In\"></form>";
      }
      else {
        echo "<p><span>" . $_SESSION["username"] . "</span> | <a href=\"logout.php\">Log out</a></p>";
      }
      ?>
    </div>
  </div>
</div>
