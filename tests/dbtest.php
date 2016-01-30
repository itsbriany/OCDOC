<!DOCTYPE html>
<?php
  require_once '../connection.php';
  require_once '../controllers/dbmanager.php';

  $dbManager = new DBManager($conn);
  $dbManager->fetchTaskList(1);

  // TODO Certain events will happen at various times of day
?>

<html>
    <head>
        <title>Time Test</title>
    </head>
    <body>

    </body>
</html>
