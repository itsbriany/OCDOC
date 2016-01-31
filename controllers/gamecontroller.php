<?php
require_once "../models/time.php";
class GameManager {
  private $time = null;

  public function __construct() {
    $time = new Time(); 
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
   *  Checks to see if the player has exhausted their actions
   *  @param $player The target Player() object
   */
  private function checkPlayerTime($player) {
    //if ($player->)  
  }
}
?>
