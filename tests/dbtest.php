<!DOCTYPE html>
<?php
  require_once '../controllers/dbmanager.php';
  require_once '../models/room.php';

  $dbManager = new DBManager();
  $location = Room::Lobby;

  $playerID = $dbManager->setPlayer(1);

  // Get the tasks based off a location
  $locationTaskList = $dbManager->fetchTaskList($location);
  var_dump($locationTaskList);
  // echo "</br>";

  echo "Player ID: " . $playerID . "</br>";

  // $dbManager->move($location);
?>

<html>
    <head>
        <title>DB Test</title>
    </head>
    <body>

    </body>
</html>
