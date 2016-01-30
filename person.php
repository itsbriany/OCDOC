<?php
class Person {

  private $stamina = 100;
  private $todoList = array();
  private $complete = 0;

  public function move() {

  }

  public function addStam($ammount) {
    return $this->stamina += $ammount;
  }

  public function removeStam($ammount) {
    return $this->stamina -= $ammount;
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
