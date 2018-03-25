<?php session_start();
include("db_header.php");
if(isset($_SESSION["logged_in"])) {
  session_unset();
  session_destroy();
  header("Location: http://" . $servername . "/comp3100/" . $_SESSION["last_page"]);
}
