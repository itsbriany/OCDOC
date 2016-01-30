<!DOCTYPE html>
<?php
include 'person.php';

$servername = "localhost";
$username = "ocdoc";
$password = "password";
$testTODO = array();
$testTODOCompleted = array();

$testPerson = new Person();

for ($i = 0; $i < 10; $i++) {
  array_push($testTODO, $i);
}

$testPerson->setTODO($testTODO);

array_push($testTODOCompleted, 1);
array_push($testTODOCompleted, 2);
array_push($testTODOCompleted, 3);
array_push($testTODOCompleted, 4);
array_push($testTODOCompleted, 5);

// test for completed tasks
$holder = $testPerson->checkTODO($testTODOCompleted);
echo $holder;
// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";


?>
<html>
  <head>
    <title>Player Stats</title>
  </head>
  <body>

  </body>
</html>
