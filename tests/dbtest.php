<!DOCTYPE html>
<?php
  require_once '../controllers/dbmanager.php';
  require_once '../models/room.php';

  $dbManager = new DBManager();
  $location = Room::IT;

  // Get the tasks based off a location
  // $locationTaskList = $dbManager->fetchTaskList($location);
  // var_dump($locationTaskList);
  echo "</br>";

  $playerID = $dbManager->setPlayer(1);
  echo "Player ID: " . $playerID . "</br>";

  $dbManager->move($location);
?>

<html>
    <head>
        <title>Time Test</title>
    </head>
    <body>

    </body>
</html>
