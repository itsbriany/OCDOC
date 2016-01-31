<?php
require_once "../models/time.php";
require_once "../models/player.php";
class GameController {
  private $time = null;
  private $currentPlayer = null;

  public function __construct() {
    $time = new Time(); 
    $currentPlayer = new Player();
  }

  /**
   *  Replaces the current time with the new time
   *  @param $time The new Time() object
   */
  public function updateTime(&$newTime) {
    // Do a check to see if the turn is up
    //$this->checkPlayerTime();
    // Do a check to see if the hour is up
    // Do a check to see if the day is up
    $this->time = $newTime; 
  }

  /**
   *  @param $player The player object
   */
  public function setCurrentPlayer($player) {
    $this->currentPlayer = $player; 
  }

  /**
   *  Checks to see if the player has exhausted their actions
   *  @param $player The target Player() object
   */
  private function checkPlayerTime($player) {
    //if ($player->)  
  }
}
?>
