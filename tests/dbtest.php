<!DOCTYPE html>
<?php
  require_once '../controllers/dbmanager.php';

  $dbManager = new DBManager();
  $location = 4;
  $locationTaskList = $dbManager->fetchTaskList($location); 
  var_dump($locationTaskList);
?>

<html>
    <head>
        <title>Time Test</title>
    </head>
    <body>

    </body>
</html>
