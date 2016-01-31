<?php
class Player {

  private $minutesLeft = 60;
  private $todoList = array();
  private $complete = 0;
  private $timeToMoveBetweenRooms = 5;

  /**
   *  Moves the player to the specified location
   *  Locations are represented by an integer
   */
  public function move($location) {
    $this->minutesLeft -= $this->timeToMoveBetweenRooms;
  }

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

  /*
     @param $taskID The task to do
     @return The response from completing the task
  */
  public function doTask($taskID) {
    // Query the database here to get the message associated with the given taskID
    // Subtract the task's time consumption from the global time
    return "Completed task " . $taskID . "</br>";
  }

}
?>
