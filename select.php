<?php
  require_once "controllers/dbmanager.php";
  require_once 'models/room.php';

  if (isset($_POST["sel1"])) {
    $newLocation = $_POST["sel1"];
    $dbManager = new DBManager();
    $playerID = $dbManager->setPlayer(1);
    $Numericallocation = 0;

    if (strtolower($newLocation) == 'it') {
    $Numericallocation = 0;
    } else if (strtolower($newLocation) == 'reception') {
    $Numericallocation = 1;
    } else if (strtolower($newLocation) == 'bathroom') {
    $Numericallocation = 2;
    } else if (strtolower($newLocation) == 'breakroom') {
    $Numericallocation = 3;
    } else if (strtolower($newLocation) == 'customersupport') {
    $Numericallocation = 4;
    } else if (strtolower($newLocation) == 'hr') {
    $Numericallocation = 5;
    } else if (strtolower($newLocation) == 'bossoffice') {
    $Numericallocation = 6;
    } else if (strtolower($newLocation) == 'lobby') {
    $Numericallocation = 7;
    } else if (strtolower($newLocation) == 'copyroom') {
    $Numericallocation = 8;
    } else  {
    $Numericallocation = 9;
    } 

    $dbManager->move($Numericallocation);

    echo $newLocation; 
  }




  if (isset($_POST["blah"])) {
    $dbManager = new DBManager();
    $playerID = $dbManager->setPlayer(1);
    echo $dbManager->getMinutes(); 
  }


?>
