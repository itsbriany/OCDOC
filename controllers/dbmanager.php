<?php
class DBManager {

  // conection data
  private $conn = null;

  // data vars
  private $playerID = 0;
  private $turnID = 0;
  private $stamina = 0;
  // task data
  private $todo = array();
  private $completed = array();

  public function __construct($conn) {
    $this->conn = $conn;
  }

  public function setPlayer($id) {

    $sql = "SELECT * FROM Players WHERE PlayerID = " . $id . ";";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
      $this->playerID = (int)$row["PlayerID"];
      $this->turnID = (int)$row["TurnID"];
      $this->stamina = (int)$row["Stamina"];
    }

    $this->todo = array();

    if ($this->playerID !== 0) {
      $sql = "SELECT Task_ID FROM TBLTODO WHERE Player_ID = " . $id . ";";
      $result = $conn->query($sql);
      while ($row = $result->fetch_assoc()) {
        array_push($row["Task_ID"]);
      }
    }
    return $this->playerID;

  }

  public function getTurnId() {
    return $this->turnID;
  }

  public function getTODO() {
    return $this->todolist;
  }

  /**
   *  Fetches the tasks from a room based off the npc that is in that room
   */
  public function fetchTaskList($npcID) {
      checkConnection();
      $sql = "SELECT TaskLinkID FROM NPC WHERE ID = " . $npcID . ";";
      $result = $conn->query($sql);
      $taskLinkID = "";
      while ($row = $conn->fetch_assoc()) {
        $taskLinkID = $result["TaskLinkID"];
        echo $taskLinkID . "</br>";
      }
      $sql = "SELECT * FROM Tasks WHERE TaskLinkID = " . $taskLinkID . ";";

      /*
      while ($row = $conn->fetch_assoc()) {
          $task = new Task($row["Task"], $row["TaskConsumption"]);
          //
          $conn->close();
          return $task;
      }
       */
  }

  private function checkConnection() {
      if ($this->conn->connect_errno) {
          // die ("Connect failed: %s\n", $conn->connect_error);
      }
  }

  // Task options are necessary
}
?>
