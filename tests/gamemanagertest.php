<?php
  require_once "../controllers/gamecontroller.php";
  require_once "../models/room.php";

  $gameManager = new GameManager();
  //$gameManager->updateTime();

  Room::printRooms();

  echo "It works!";
?>
