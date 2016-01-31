<!DOCTYPE html>
<?php
  require_once '../controllers/dbmanager.php';
  require_once '../models/room.php';

  $dbManager = new DBManager();
$location = Room::CustomerSupport;

  // Get the tasks based off a location
  $locationTaskList = $dbManager->fetchTaskList($location);
  var_dump($locationTaskList);
  echo "</br>"
?>

<html>
    <head>
        <title>Time Test</title>
    </head>
    <body>

    </body>
</html>
