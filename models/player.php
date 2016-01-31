<?php
require_once "../models/room.php";
class Player {

  private $minutesLeft = 60;
  private $todoList = array();
  private $complete = 0;
  private $location = Room::Lobby;

  const TimeToMoveBetweenRooms = 5;
  
  public function addMinutes($ammount) {
    return $this->minutes += $ammount;
  }

  public function removeMinutes($ammount) {
    return $this->minutes -= $ammount;
  }

  public function setTODO($list) {
    $this->todoList = $list;
  }

  public function checkTODO($list) {
    $test = true;
    $matchCount = 0;
    foreach ($this->todoList as $value) {
      if (!in_array($value, $list)) {
        $test = false;
      } else {
        $matchCount++;
      }
    }
    count($this->todoList);
    $this->complete = ($matchCount / count($this->todoList)) * 100;
    return $test;
  }

  public function getCompleteRating() {
    return $this->complete;
  }

}
?>
