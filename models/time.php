<?php
class Time {
  private $minutes = 0;
  private $hours = 0;
  private $days = 0;

  public function getMinutes() {
    return $this->minutes;
  }

  public function setMinutes($minutes) {
    $this->minutes = $minutes; 
  }

  public function getHours() {
    return $this->hours; 
  }

  public function setHours($hours) {
    $this->hours = $hours; 
  }

  public function getDays() {
    return $this->days; 
  }

  public function setDays($days) {
    $this->days = $days; 
  }
}
?>
