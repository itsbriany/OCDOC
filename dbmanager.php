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
    die ("Connection failed: " . $conn->connect_error) . "</br>";
  }
  echo "Connected successfully</br>";

  $conn->close();

  public function setPlayer($id) {

    $sql = "SELECT PlayerID FROM Players WHERE PlayerID = " . $id . ";";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      $this->playerID = (int)$row["PlayerID"];
    }

    return $this->platerID;

  }

  public function getTurnId() {
    $sql = "SELECT "
  }

  public function getTODO() {

  }
}
?>
