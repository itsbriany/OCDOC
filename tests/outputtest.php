<!DOCTYPE html>
<?php
include '../models/person.php';
// connection info
$servername = "localhost";
$username = "ocdoc";
$password = "password";

// array of tasks to complete
$testTODO = array();
// tasks that have been completed
$testTODOCompleted = array();

// player person object
$testPlayer = new Player();

// popluate TODO list with dummy data
for ($i = 0; $i < 10; $i++) {
  array_push($testTODO, $i);
}

// set the tasks required to win
$testPlayer->setTODO($testTODO);

// add some some completed tasks
array_push($testTODOCompleted, 1);
array_push($testTODOCompleted, 2);
array_push($testTODOCompleted, 3);
array_push($testTODOCompleted, 4);
array_push($testTODOCompleted, 5);

// test for completed tasks
echo $holder = ($testPlayer->checkTODO($testTODOCompleted)) ? 'test one pass </br>' : 'test one fail </br>';

echo $testPlayer->getCompleteRating() . "% match</br> ";

// add all the required tasks and some extras
array_push($testTODOCompleted, 0);
array_push($testTODOCompleted, 6);
array_push($testTODOCompleted, 7);
array_push($testTODOCompleted, 8);
array_push($testTODOCompleted, 9);
array_push($testTODOCompleted, 10);
array_push($testTODOCompleted, 11);

// second test for completed tasks
echo $holder = ($testPlayer->checkTODO($testTODOCompleted)) ? 'test two pass </br>' : 'test two fail </br>';
echo $testPlayer->getCompleteRating() . "% match</br> ";
// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error) . "</br>";
}
echo "Connected successfully</br>";


?>
<html>
  <head>
    <title>Player Stats</title>
  </head>
  <body>

  </body>
</html>
