<?php
class DBManager {

  // conection data
  private $servername = "localhost";
  private $username = "ocdoc";
  private $password = "password";
  private $dbname = "ocdoc";

  // data vars
  private $playerID = 0;
  private $turnID = 0;
  private $name = 0;
  // task data
  private $todo = array();
  private $completed = array();


  public function setPlayer($id) {

    $sql = "SELECT * FROM Players WHERE Player_ID = " . $id . ";";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
      $this->playerID = (int)$row["Player_ID"];
      $this->turnID = (int)$row["Turn_ID"];
      $this->name = $row["Name"];
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
  public function fetchTaskList($location) {
      $conn = $this->openConnection();
      // $sql = "SELECT * FROM Tasks LEFT JOIN NPC ON NPC.TaskLink_ID = Tasks.TaskLink_ID WHERE Tasks.TaskLink_ID = `SecretaryTask` AND Tasks.Req_Room = 4";
      $taskListID = $this->findTaskListID($conn, $location);
      if (!$taskListID) {
        echo "Could not fetch task list ID"; 
        $this->closeConnection($conn); 
        return;
      }
      $sql = "SELECT * FROM Tasks LEFT JOIN NPC ON NPC.TaskLink_ID = Tasks.TaskLink_ID WHERE Tasks.TaskLink_ID = " . $taskListID . " AND Tasks.Req_Room =" . $location . ";";
      if ($result = $conn->query($sql)) {
        while ($row = $result->fetch_assoc()) {
          echo $row["Task"] . "</br>";
        }
      }
      $this->closeConnection($conn); 
  }

  private function findTaskListID($conn, $location) {
    $sql = "SELECT TaskLink_ID FROM NPC WHERE Location = " . $location . ";";
    if (!$result = $conn->query($sql)) {
      return;
    }
    while ($row = $result->fetch_assoc()) {
    
    }
    $taskListID = $row["TaskList_ID "]; 
    return $taskListID;
  }

  /**
   *  @return The mysqli connection object
   */
  public function openConnection() {
    $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    if ($conn->connect_error) {
      $this->errorMsg($conn);
    }
    echo "Connected successfully</br>";
    return $conn;
  }

  private function closeConnection($conn) {
    if (!$conn->close()) {
      $this->errorMsg($conn);
    } 
    echo "closing connection </br>";
  }

  /**
   *  @param $conn The mysqli connection object
   */
  private function errorMsg($conn) {
    die ("Failed to close connection: ". $conn->connect_errno . "</br>"); 
  }

  
}
?>
