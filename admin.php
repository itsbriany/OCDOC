<?php

require_once "controllers/dbmanager.php";
$dbManager = new DBManager();

if (isset($_POST['redirect'])){
  $dbManager->setDay($_POST["day"]);
} else if (isset($_POST['redirect2'])) {
  $dbManager->setHour($_POST["hour"]);
} else if (isset($_POST['redirect3'])) {
  print_r($_POST);
  $dbManager->setHour($_POST["redirect3"]);
  $dbManager->changeHour($_POST["redirect3"]);
}

$browser = $_SERVER['HTTP_USER_AGENT'];
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Using QueryStrings</title>
  </head>
  <body>
    <form method="post">

      <p>
        <input type="text" name="day">
        <input type="submit" name="redirect" value="Set day"><br>
      </p>
      <p>
        <input type="text" name="hour">
        <input type="submit" name="redirect2" value="Set hour"><br>
      </p>
      <p>
        <input type="submit" name="redirect3" value="8"><br>
      </p>
      <p>
        <input type="submit" name="redirect3" value="9"><br>
      </p>
      <p>
        <input type="submit" name="redirect3" value="10"><br>
      </p>
      <p>
        <input type="submit" name="redirect3" value="11"><br>
      </p>
      <p>
        <input type="submit" name="redirect3" value="12"><br>
      </p>
      <p>
        <input type="submit" name="redirect3" value="1"><br>
      </p>
      <p>
        <input type="submit" name="redirect3" value="2"><br>
      </p>
      <p>
        <input type="submit" name="redirect3" value="3"><br>
      </p>
      <p>
        <input type="submit" name="redirect3" value="4"><br>
      </p>
      <p>
        <input type="submit" name="redirect3" value="5"><br>
      </p>
    </form>
  </body>
</html>
