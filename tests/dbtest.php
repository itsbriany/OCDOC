<!DOCTYPE html>
<?php
  require_once '../controllers/dbmanager.php';
  require_once '../models/room.php';

  $dbManager = new DBManager();
  $location = Room::IT;

  // Get the tasks based off a location
  // $locationTaskList = $dbManager->fetchTaskList($location);
  // var_dump($locationTaskList);
  // echo "</br>";

  $playerID = $dbManager->setPlayer(2);
  echo "Player ID: " . $playerID . "</br>";

  $dbManager->move($location);
?>

<html>
    <head>
        <title>DB Test</title>
    </head>
    <body>

    </body>
</html>
