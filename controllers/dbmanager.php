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
  private $location = 0;

  private $day = 0;
  private $hour = 0;
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
      $this->location = $row["Location"];
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
<<<<<<< HEAD

    }
    $taskListID = $row["TaskList_ID "];
    return $taskListID;
=======
      $taskListID = $row["TaskList_ID"];
      return $taskListID;
    }
>>>>>>> origin/master
  }

  public function getDay() {
    $conn = $this->openConnection();

    $sql = "SELECT Day FROM TBLTime;";
    if ($result = $conn->query($sql)) {
      $this->day = $result["Day"];
    }

    $this->closeConnection($conn);
    return $this->day;
  }

  public function getHour() {
    $conn = $this->openConnection();

    $sql = "SELECT Hour FROM TBLTime;";
    if ($result = $conn->query($sql)) {
      $this->hour = $result["Hour"];
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
<<<<<<< HEAD


=======
>>>>>>> origin/master
}
?>
