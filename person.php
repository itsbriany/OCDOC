<?php
class Person {

  private $stamina = 100;
  private $todoList = array();
  private $complete = true;

  public function move() {

  }

  public function addStam($ammount) {
    $this->stamina += $ammount;
  }

  public function removeStam($ammount) {
    $this->stamina -= $ammount;
  }

  public function setTODO($list) {
    $this->todoList = $list;
  }

  public function checkTODO($list) {
    $test = true;
    foreach ($this->todoList as $value) {
      if (!in_array($value, $list)) {
        return false;
      }
    }
    return $test;
    //echo $this->complete;
  }

}
?>
