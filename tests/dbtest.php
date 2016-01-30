<!DOCTYPE html>
<?php
  require_once '../controllers/dbmanager.php';

  $dbManager = new DBManager();
  $location = 4;
  $dbManager->fetchTaskList($location); 

  // TODO Certain events will happen at various times of day
?>

<html>
    <head>
        <title>Time Test</title>
    </head>
    <body>

    </body>
</html>
