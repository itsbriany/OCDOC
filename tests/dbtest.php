<!DOCTYPE html>
<?php
  require_once '../models/task.php';
  require_once '../models/person.php';
  include '../controllers/dbmanager.php';

  // conection data
  $servername = "localhost";
  $username = "ocdoc";
  $password = "password";
  $dbname = "ocdoc";
  $conn = mysqli_connect($servername, $username, $password);

  // Check connection
  if ($conn->connect_error) {
    die ("Connection failed: " . $conn->connect_error) . "</br>";
  }
  echo "Connected successfully</br>";

  $conn->close();

  
  $DBManager = new DBManager($conn);
?>

<html>
    <head>
        <title>Time Test</title>
    </head>
    <body>
    
    </body>
</html>
