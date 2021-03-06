<?php
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
    echo "task time complete </br>!";
    $playerTime = $this->getPlayerMinutes($conn);
    if (!$playerTime) {
      return;
    }
    echo "player time complete </br>!";
    $newMinutes = $playerTime - $taskTime;
    echo "new amount complete </br>!";
    if ($newMinutes <= 0) {
      $newMinutes = 0;
      // TODO Turn complete
      $this->completePlayerTurn();
    }
    // Subtract player time
    $this->updatePlayerMinutes($conn, $newMinutes);
    $updatedPlayerMins = $this->getPlayerMinutes($conn);
    $this->closeConnection($conn);
    return $updatedPlayerMins;
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
    if (!$playerOldMinutes) {
      return;
    }
    $currentMinutes = $playerOldMinutes - self::TimeToMoveBetweenRooms;
    if ($currentMinutes <= 0) {
      $currentMinutes = 60;
      // TODO Turn complete
      $this->completePlayerTurn();
    }
    $this->updatePlayerMinutes($conn, $currentMinutes);
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

    $this->closeConnection($conn);
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

  public function moveNPC($NPCName, $location) {
    $conn = $this->openConnection();
    $sql = "UPDATE NPC SET Location = " . $location . " WHERE Name = '". $NPCName ."';";
    $conn->query($sql);
    $this->closeConnection($conn);
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

  /**
   *  @return The time it takes to complete a task
   *  @param $conn The mysqli connection object
   *  @param $taskID The integer representing the task id
   */
  public function getTaskTime($conn, $taskID) {
    $sql = "SELECT TimeConsumption FROM Tasks WHERE Task_ID = " . $taskID . ";";
    $result = $conn->query($sql);
    if (!$result) {
      return;
    }
    while ($row = $result->fetch_assoc()) {
      return $row["TimeConsumption"];
    }
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

  public function changeHour($hour) {
    echo "change hour ran </br>";
    $conn = $this->openConnection();
    if ($hour = 9) {
      $sql = "UPDATE NPC SET LOCATION = 3 WHERE ID = 2;" .
        "UPDATE NPC SET LOCATION = 1 WHERE ID = 3;".
        "UPDATE NPC SET LOCATION = 5 WHERE ID = 4;".
        "UPDATE NPC SET LOCATION = 4 WHERE ID = 5;".
        "UPDATE NPC SET LOCATION = 4 WHERE ID = 6;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 7;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 8;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 9;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 10;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 11;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 12;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 13;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 14;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 15;".
        "UPDATE NPC SET Location = 3 where is = 16;";

    } elseif ($hour = 10) {
      $sql = "UPDATE NPC SET LOCATION = 2 WHERE ID = 2;" .
        "UPDATE NPC SET LOCATION = 1 WHERE ID = 3;".
        "UPDATE NPC SET LOCATION = 3 WHERE ID = 4;".
        "UPDATE NPC SET LOCATION = 4 WHERE ID = 5;".
        "UPDATE NPC SET LOCATION = 4 WHERE ID = 6;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 7;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 8;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 9;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 10;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 11;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 12;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 13;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 14;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 15;".
        "UPDATE NPC SET Location = 3 where is = 16;";

    } elseif ($hour = 11) {
      $sql = "UPDATE NPC SET LOCATION = 5 WHERE ID = 2;" .
        "UPDATE NPC SET LOCATION = 1 WHERE ID = 3;".
        "UPDATE NPC SET LOCATION = 3 WHERE ID = 4;".
        "UPDATE NPC SET LOCATION = 4 WHERE ID = 5;".
        "UPDATE NPC SET LOCATION = 4 WHERE ID = 6;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 7;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 8;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 9;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 10;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 11;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 12;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 13;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 14;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 15;".
        "UPDATE NPC SET Location = 3 where is = 16;";

    } elseif ($hour = 12) {
      $sql = "UPDATE NPC SET LOCATION = 4 WHERE ID = 2;" .
        "UPDATE NPC SET LOCATION = 1 WHERE ID = 3;".
        "UPDATE NPC SET LOCATION = 3 WHERE ID = 4;".
        "UPDATE NPC SET LOCATION = 2 WHERE ID = 5;".
        "UPDATE NPC SET LOCATION = 4 WHERE ID = 6;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 7;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 8;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 9;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 10;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 11;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 12;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 13;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 14;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 15;".
        "UPDATE NPC SET Location = 3 where is = 16;";

    } elseif ($hour = 1) {
      $sql = "UPDATE NPC SET LOCATION = 4 WHERE ID = 2;" .
        "UPDATE NPC SET LOCATION = 1 WHERE ID = 3;".
        "UPDATE NPC SET LOCATION = 5 WHERE ID = 4;".
        "UPDATE NPC SET LOCATION = 2 WHERE ID = 5;".
        "UPDATE NPC SET LOCATION = 4 WHERE ID = 6;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 7;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 8;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 9;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 10;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 11;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 12;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 13;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 14;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 15;".
        "UPDATE NPC SET Location = 3 where is = 16;";

    } elseif ($hour = 2) {
      $sql = "UPDATE NPC SET LOCATION = 9 WHERE ID = 2;" .
        "UPDATE NPC SET LOCATION = 1 WHERE ID = 3;".
        "UPDATE NPC SET LOCATION = 5 WHERE ID = 4;".
        "UPDATE NPC SET LOCATION = 8 WHERE ID = 5;".
        "UPDATE NPC SET LOCATION = 4 WHERE ID = 6;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 7;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 8;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 9;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 10;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 11;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 12;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 13;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 14;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 15;".
        "UPDATE NPC SET Location = 2 where is = 16;";

    } elseif ($hour = 3) {
      $sql = "UPDATE NPC SET LOCATION = 3 WHERE ID = 2;" .
        "UPDATE NPC SET LOCATION = 1 WHERE ID = 3;".
        "UPDATE NPC SET LOCATION = 5 WHERE ID = 4;".
        "UPDATE NPC SET LOCATION = 8 WHERE ID = 5;".
        "UPDATE NPC SET LOCATION = 4 WHERE ID = 6;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 7;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 8;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 9;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 10;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 11;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 12;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 13;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 14;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 15;".
        "UPDATE NPC SET Location = 2 where is = 16;";

    } elseif ($hour = 4) {
      $sql = "UPDATE NPC SET LOCATION = 4 WHERE ID = 2;" .
        "UPDATE NPC SET LOCATION = 1 WHERE ID = 3;".
        "UPDATE NPC SET LOCATION = 5 WHERE ID = 4;".
        "UPDATE NPC SET LOCATION = 8 WHERE ID = 5;".
        "UPDATE NPC SET LOCATION = 4 WHERE ID = 6;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 7;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 8;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 9;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 10;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 11;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 12;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 13;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 14;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 15;".
        "UPDATE NPC SET Location = 2 where is = 16;";

    } elseif ($hour = 5) {
      $sql = "UPDATE NPC SET LOCATION = 3 WHERE ID = 2;" .
        "UPDATE NPC SET LOCATION = 1 WHERE ID = 3;".
        "UPDATE NPC SET LOCATION = 5 WHERE ID = 4;".
        "UPDATE NPC SET LOCATION = 8 WHERE ID = 5;".
        "UPDATE NPC SET LOCATION = 4 WHERE ID = 6;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 7;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 8;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 9;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 10;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 11;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 12;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 13;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 14;".
        "UPDATE NPC SET LOCATION = 13 WHERE ID = 15;".
        "UPDATE NPC SET Location = 2 where is = 16;";

    }

    if ($result = $conn->query($sql)) {
      $this->day = $day;
    }
    $this->closeConnection($conn);
  }

  public function setDay($day) {
    $conn = $this->openConnection();
    $sql = "UPDATE TBLTime SET Day = " . $day . ";";
    if ($result = $conn->query($sql)) {
       $this->day = $day;
    }
    $this->closeConnection($conn);
  }

  public function setHour($hour) {
    echo "ger hndfghx ";
    $conn = $this->openConnection();
    $sql = "UPDATE TBLTime SET hour = " . $hour . ";";
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
    //echo "Connected successfully</br>";
    return $conn;
  }

  private function getPlayerMinutes($conn) {
    $sql = "SELECT Minutes FROM Players WHERE Player_ID = " . $this->playerID . ";";
    $result = $conn->query($sql);
    if (!$result) {
      return 0;
    }
    $currentMinutes = null;
    if ($row = $result->fetch_assoc()) {
      $oldMinutes = $row["Minutes"];
    }
    return $oldMinutes;
  }

  private function updatePlayerMinutes($conn, $newPlayerMinutes) {
    $sql = "UPDATE Players SET Minutes = " . $newPlayerMinutes . " WHERE Player_ID = " . $this->playerID .";";
    $conn->query($sql);
  }

  private function updatePlayerLocation($conn, $location) {
    $sql = "UPDATE Players SET Location = " . $location . " WHERE Player_ID = " . $this->playerID . ";";
    $conn->query($sql);
  }


  private function closeConnection($conn) {
    if (!$conn->close()) {
      $this->errorMsg($conn);
    }
    //echo "closing connection </br>";
  }

  /**
   *  @param $conn The mysqli connection object
   */
  private function errorMsg($conn) {
    die ("Failed to close connection: ". $conn->connect_errno . "</br>");
  }
}
?>
