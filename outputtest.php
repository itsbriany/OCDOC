<!DOCTYPE html>
<?php
$servername = "localhost";
$username = "ocdoc";
$password = "password";

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
