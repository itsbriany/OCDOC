<!DOCTYPE html>
<?php
  require_once '../models/task.php';
  require_once '../models/person.php';

  $person = new Person();

  // Keep people actions in mind
  // Display the time required near each action

  // Attempt one of the tasks from the task list
  $taskID = 2;
  echo $person->doTask($taskID);
?>

<html>
    <head>
        <title>Time Test</title>
    </head>
    <body>
    
    </body>
</html>
