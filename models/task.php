<?php
class Task {
  private $description = "";
  private $timeConsumption = 0;

  public function __construct($description, $timeConsumption) {
      $this->description = $description;
      $this->timeConsumption = $timeConsumption;
  }
    
  public function getDescription() {
      return $description;
  }

  public function setDescription($newDescription) {
      $this->description = $newDescription;
  }

  public function getTimeConsumption() {
      return $timeConsumption;
  }

  public function setTimeConsumption($timeConsumption) {
      $this->timeConsumption = (int) $timeConsumption;
  }
}
?>
