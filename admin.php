<?php

require_once "controllers/dbmanager.php";
$dbManager = new DBManager();

if (isset($_POST['redirect'])){
  $dbManager->setDay($_POST["day"]);
} else if (isset($_POST['redirect2'])) {
  $dbManager->setHour($_POST["hour"]);
} else if (isset($_POST['redirect3'])) {
  $result = "ASP.Net? Awesome Possum!!!";
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
        <input type="submit" name="redirect3" value="Move NPC to location (NPC is a name, location is a number between 1-10 inclusive)"><br>
      </p>

    </form>
  </body>
</html>
