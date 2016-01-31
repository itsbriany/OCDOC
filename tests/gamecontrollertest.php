<?php
  require_once "../controllers/gamecontroller.php";
  require_once "../models/room.php";

  $gameController = new GameController();

  Room::printRooms();

  echo "It works!";

  function playTurn() {
  
  }
?>
