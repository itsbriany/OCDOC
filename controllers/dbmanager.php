<?php
class DBManager {

  // conection data
  private $servername = "localhost";
  private $username = "ocdoc";
  private $password = "password";
  private $conn = new mysqli($servername, $username, $password);

  // data vars
  private $playerID = 0;
  private $turnID = 0;
  private $stamina = 0;
  // task data
  private $todo = array();
  private $completed = array();

  // Check connection
  if ($conn->connect_error) {
    return ("Connection failed: " . $conn->connect_error) . "</br>";
  }
  echo "Connected successfully</br>";

  public function setPlayer($id) {

  }

  public function getTurnId() {

  }

  public function getTODO() {

  }

  public function getTask($taskID) {
      checkConnection();
      $sql = "SELECT Task, TimeConsumption FROM Tasks WHERE TaskID = " . $taskID . ";";
      $result = $conn->query($sql);
      while ($row = $conn->fetch_assoc()) {
          $task = new Task($row["Task"], $row["TaskConsumption"]);
          return $task;
      }
  }

  private function checkConnection() {
      if ($this->conn->connect_errno) {
          printf("Connect failed: %s\n", $mysqli->connect_error);
          exit();
      }
  }
}
?>
