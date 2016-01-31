<!doctype html>
<html>
  <?php
  require_once "controllers/dbmanager.php";
  require_once "models/time.php";
  require_once "models/player.php";

  $assetsDirectory = "assets/images/";

  $dbManager = new DBManager();
  $playerID = 1;

  $dbManager->setPlayer($playerID);

  print_r($_POST);

  if (isset($_POST["task"])) {
    $dbManager->doTaskForPerson($_POST["taskid"]);
  } else {
    echo "IM NOT SET";
  }

  $day = $dbManager->getDay();
  $hour = $dbManager->getHour();
  $name = $dbManager->getName();
  $location = $dbManager->getLocation();
  $avalableTasks = $dbManager->fetchTaskList($location);
  $timeLeft = $dbManager->getMinutes();

  $rooms = array("IT", "Reception", "Bathroom", "BreakRoom", "CustomerSupport", "HR", "BossOffice", "Lobby", "CopyRoom", "BoardRoom");


  $showModal = false;

  ?>
  <head>

    <!--<meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />-->
    <meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>

  </head>
  <script type='text/javascript'>
    // Show modal
    $(document).ready(function(){
      $('#confermModal').modal('show');
      $('#modalLast').focus();
    });
  </script>

  <?php if($avalableTasks): ?>
  <?php foreach($avalableTasks as $key => $items): ?>
  <?php
  $image = "https://placehold.it/350x150";
  if(isset($items["Name"])) {
    if (strtolower($items["Name"]) == "douche dan") {
      $image = $assetsDirectory . "douche.png";
    } else if (strtolower($items["Name"]) == "secretary") {
      $image = $assetsDirectory . "secretary.png";
    } else if (strtolower($items["Name"]) == "sally slacker") {
      $image = $assetsDirectory . "slacker.png";
    } else if (strtolower($items["Name"]) == "jenny joker") {
      $image = $assetsDirectory . "joker.png";
    } else if (strtolower($items["Name"]) == "reception") {
      $image = $assetsDirectory . "reception.png";
    } else if (strtolower($items["Name"]) == "bathroom") {
      $image = $assetsDirectory . "bathroom.png";
    } else if (strtolower($items["Name"]) == "breakroom") {
      $image = $assetsDirectory . "breakroom.png";
    } else if (strtolower($items["Name"]) == "customersupport") {
      $image = $assetsDirectory . "customersupport.png";
    } else if (strtolower($items["Name"]) == "hr") {
      $image = $assetsDirectory . "hr.png";
    } else if (strtolower($items["Name"]) == "bossoffice") {
      $image = $assetsDirectory . "bossoffice.png";
    } else if (strtolower($items["Name"]) == "lobby") {
      $image = $assetsDirectory . "lobby.png";
    } else if (strtolower($items["Name"]) == "copyroom") {
      $image = $assetsDirectory . "copyroom.png";
    } else if (strtolower($items["Name"]) == "boardroom") {
      $image = $assetsDirectory . "boardroom.png";
    } else if (strtolower($items["Name"]) == "it guy") {
      $image = $assetsDirectory . "it.png";
    }
  }
  echo "<div class=\"modal fade option\" id=\"modal" . ($key + 1) . "\" role=\"dialog\">
    <form id=\"" . $key . "\" method=\"post\">
      <div class=\"modal-dialog\">
          <div class=\"modal-content\">
              <div class=\"modal-header\">
                  <img src=\"" . $image . "\" class=\".img-responsive\" style=\"width:100%\" alt=\"Image\">
              </div>
            <div class=\"modal-body\">
              <p class=\"modalBody\">";
  echo $avalableTasks[$key]["Description"];
  echo "</p>
              <div class=\"modal-footer\">
              <button type=\"button\" class=\"btn btn-danger btnClose\" data-dismiss=\"modal\">Close</button>
              <input type=\"hidden\" name=\"taskid\" value=\"" . $items["Task_ID"] . "\">
              <input type=\"submit\" name=\"task\" class=\"btn btn-success\" value=\"Okay\"><br>

              </div>
            </div>
          </div>
        </div>
      </form>
    </div>";  ?>
  <?php endforeach; ?>
  <?php endif; ?>
  <body>


    <?php if(!$showModal) { ?>
    <!-- ======================================== MAIN PAGE -->
    <div class="mainContainer">
      <div class="mainHeader">

        <!-- THIS IS WHERE THE DAY / HOUR IS SHOWN -->
        <div class="row">
          <p class="col-xs-6 currentDay">Day: <?php echo $day; ?></p>

          <p class="col-xs-6 currentHour"> Hour: <?php echo $hour; ?></p>
        </div>
      </div>

      <!-- THIS IS WHERE THE ROOM DROP-DOWN IS -->
      <div class="roomSelector">
        <p class="roomSelectorText">You are currently in: <?php echo $rooms[$location] ?></p>
        <div class="form-group">
          <label for="sel1">Select Room:</label>
          <select class="form-control" id="sel1">
            <?php if($rooms): ?>
            <?php foreach($rooms as $key => $items): ?>
            <?php echo " <option> " . $items . "</option>"; ?>
            <?php endforeach; ?>
            <?php endif; ?>
          </select>

        </div>
      </div>

      <!-- THIS IS WHERE THE BUTTONS FOR OPTIONS ARE SHOWN -->
      <div class="btn-group-vertical mainBody">
        <?php if($avalableTasks): ?>
        <?php foreach($avalableTasks as $key => $items): ?>
        <?php echo "<button type=\"button\" class=\"btn userOptions\" data-toggle=\"modal\" data-target=\"#modal" . ($key + 1) . "\">" . $items["Task"] . "  <span class=\"timeNeeded\"><br> Time to Complete: " . $items["TimeConsumption"] .  "</span></button>";  ?>
        <?php endforeach; ?>
        <?php endif; ?>
      </div>

      <div class="mainFooter">
        <p class="userMinutes">You have <?php echo $timeLeft; ?> minutes left.</p>

        <!-- THIS BUTTON TAKES YOU TO THE INFO PAGE FOR YOUR CHARACTER -->
        <button class="btn btn-dark infoButton" type="button" >Player Info</button>
        <!-- THIS BUTTON SHOULD END YOUR TURN -->
        <button class="btn btn-danger endTurnBtn" type="button">End Turn</button>
      </div>
    </div>
    <?php } ?>


    <?php if($showModal) { ?>
    <!-- PROFILE PAGE -->
    <div class="profile profileBack">
      <div class="upperProfile">
        <!-- THIS IS WHERE YOUR CHARACTER'S NAME GOES -->
        <p class="profileName">NAME LAST</p>
        <!-- THIS IS WHERE YOUR CHARACTER'S PHOTO GOES -->
        <img class="profileIcon" src="https://placehold.it/100x150" alt="some_text">
        <!-- THIS IS WHERE YOUR CHARACTER'S JOB TITLE / CLASS GOES -->
        <p class="profileJob">JOB TITLE</p>
      </div>

      <!-- THIS IS WHERE THE STATS / INVENTORY / TASKS GO -->
      <div class="lowerProfile">
        <div id="Carousel" class="carousel slide profileCarousel" data-ride="carousel" data-interval="false">
          <!-- Wrapper for carousel items -->
          <div class="carousel-inner">
            <!-- INVENTORY -->
            <div class="item active">
              <p class="carouselTitle">INVENTORY</p>
              <p class="carouselObjects">ITEM 1</p>
              <p class="carouselObjects">ITEM 2</p>
              <p class="carouselObjects">ITEM 3</p>
              <p class="carouselObjects">ITEM 4</p>
            </div>
            <!-- TASKS -->
            <div class="item">
              <p class="carouselTitle">TASKS</p>
              <p class="carouselObjects">TASK 1</p>
              <p class="carouselObjects">TASK 2</p>
              <p class="carouselObjects">TASK 3</p>
              <p class="carouselObjects">TASK 4</p>
            </div>
            <!-- STATS -->
            <div class="item">
              <p class="carouselTitle">STATS</p>
              <p class="carouselObjects">STAT 1</p>
              <p class="carouselObjects">STAT 2</p>
              <p class="carouselObjects">STAT 3</p>
              <p class="carouselObjects">STAT 4</p>
            </div>
          </div>
          <!-- Carousel controls -->
          <a class="carousel-control left" data-target="#Carousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
          </a>
          <a class="carousel-control right" data-target="#Carousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
          </a>
        </div>
      </div>
    </div>
    <?php } ?>




  </body>

</html>
