<?php
// require_once "../models/player.php";
class DBManager {

  private $className = "DBManager";

  // conection data
  private $servername = "localhost";
  private $username = "ocdoc";
  private $password = "password";
  private $dbname = "ocdoc";

  // data vars
  private $playerID = 0;
  private $turnID = 0;
  private $name = 0;
  private $location = 0;

  private $day = 0;
  private $hour = 0;
  // task data
  private $todo = array();
  private $completed = array();

  const TimeToMoveBetweenRooms = 5;

  /**
   *  Does a task for a person and consumes the person's time accordingly
   */
  public function doTaskForPerson($taskID) {
    $conn = $this->openConnection();  
    // Get task time
    $taskTime = $this->getTaskTime($conn, $taskID);
    // Subtract player time
    $sql = "UPDATE ";
    $this->getPlayerMinutes($conn);
    $this->consumePlayerMinutes($conn, $newPlayerMinutes);
    $this->closeConnection();
  }

  /**
   *  Moves the player to the specified location
   *  Locations are represented by an integer
   */
  public function move($location) {
    // Sanitize the location
    if ($location < 1) {
      return;
    }
    if ($location > 10) {
      $location = ($location % 10) + 1;
    }
    if (!$this->playerID) {
      die ($className . ": Could not move player due to missing player ID!"); 
    }
    $conn = $this->openConnection();
    $playerOldMinutes = $this->getPlayerMinutes($conn);
    $currentMinutes = $playerOldMinutes - self::TimeToMoveBetweenRooms; 
    if ($currentMinutes < 0) {
      $currentMinutes = 60; 
      // TODO Turn complete
      $this->completePlayerTurn();
    }
    $this->consumePlayerMinutes($conn, $currentMinutes);
    $this->updatePlayerLocation($conn, $location);
    $this->closeConnection($conn);
  }

  public function completePlayerTurn() {
    echo $this->className . "::completePlayerTurn: FIXXX MEEEEEEE!!"; 
  }

  public function setPlayer($id) {
    $conn = $this->openConnection();
    $sql = "SELECT * FROM Players WHERE Player_ID = " . $id . ";";
    $result = $conn->query($sql);


    //if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()){
      $this->playerID = (int)$row["Player_ID"];
      $this->turnID = (int)$row["Turn_ID"];
      $this->name = $row["Name"];
      $this->location = $row["Location"];
    }

    $this->todo = array();

    if ($this->playerID !== 0) {
      $sql = "SELECT Task_ID FROM TBLTODO WHERE Player_ID = " . $id . ";";
      $result = $conn->query($sql);
      while ($row = $result->fetch_assoc()) {
        array_push($this->todo, $row["Task_ID"]);
      }
    }
    return $this->playerID;

  }

  /**
   *  @return The minutes associated with the provided player id
   */
  public function getMinutes() {
    $conn = $this->openConnection(); 
    $playerMinutes = $this->getPlayerMinutes($conn); 
    $this->closeConnection($conn);
    return $playerMinutes;
  }

  public function getTurnId() {
    return $this->turnID;
  }

  public function getTODO() {
    return $this->todolist;
  }

  public function getName() {
    return $this->name;
  }

  public function getLocation() {
    return $this->location;
  }

  public function setLocation($location) {
    $this->location = $location;
  }

  /**
   *  Fetches the tasks from a room based off the npc that is in that room
   *  @return A two dimensional array representing the location's task list
   */
  public function fetchTaskList($location) {
      $conn = $this->openConnection();
      $taskListID = $this->findTaskListID($conn, $location);
      if (!$taskListID) {
        echo "Could not fetch task list ID";
        $this->closeConnection($conn);
        return;
      }
      $sql = "SELECT * FROM Tasks LEFT JOIN NPC ON NPC.TaskList_ID = Tasks.TaskList_ID WHERE Tasks.TaskList_ID = \"" . $taskListID . "\" AND Tasks.Req_Room = " . $location . ";";
      if ($result = $conn->query($sql)) {
        $locationTaskList = array();
        while ($row = $result->fetch_assoc()) {
          array_push($locationTaskList, $row);
        }
        return $locationTaskList;
      }
      $this->closeConnection($conn);
  }

  private function findTaskListID($conn, $location) {
    $sql = "SELECT TaskList_ID FROM NPC WHERE Location = " . $location . ";";
    if (!$result = $conn->query($sql)) {
      return;
    }
    while ($row = $result->fetch_assoc()) {
      $taskListID = $row["TaskList_ID"];
      return $taskListID;
    }

  }

  public function getTaskTime($conn, $taskID) {
    $sql = "SELECT TimeConsumption FROM "; 
  }

  public function getDay() {
    $conn = $this->openConnection();

    $sql = "SELECT Day FROM TBLTime;";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
      $this->day = $row["Day"];
    }

    $this->closeConnection($conn);
    return $this->day;
  }

  public function getHour() {
    $conn = $this->openConnection();

    $sql = "SELECT Hour FROM TBLTime;";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
      $this->hour = $row["Hour"];
    }

    $this->closeConnection($conn);
    return $this->hour;
  }

  public function setDay($day) {
    $conn = $this->openConnection();
    $sql = "UPDATE TBLTime SET Day = " . $day . " WHERE ID = 1;";
    if ($result = $conn->query($sql)) {
       $this->day = $day;
    }
    $this->closeConnection($conn);
  }

  public function setHour($hour) {
    $conn = $this->openConnection();
    $sql = "UPDATE TBLTime SET hour = " . $hour . " WHERE ID = 1;";
    if ($result = $conn->query($sql)) {
      $this->hour = $hour;
    }
    $this->closeConnection($conn);
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

  private function getPlayerMinutes($conn) {
    $sql = "SELECT Minutes FROM Players WHERE Player_ID = '" . $this->playerID . "';";
    $result = $conn->query($sql);
    $currentMinutes = null;
    if ($row = $result->fetch_assoc()) {
      $oldMinutes = $row["Minutes"];
    }
    if (!$oldMinutes) {
      die ($this->className . ": could not find Minutes for Player with ID " . $this->playerID); 
    }
    return $oldMinutes;
  }

  private function consumePlayerMinutes($conn, $newPlayerMinutes) {
    $sql = "UPDATE Players SET Minutes = " . $newPlayerMinutes . " WHERE Player_ID = " . $this->playerID .";";
    $conn->query($sql);
  }

  private function updatePlayerLocation($conn, $location) {
    $sql = "UPDATE Players SET Location = '" . $location . "' WHERE Player_ID = " . $this->playerID . ";";
    $conn->query($sql);
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
