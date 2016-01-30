<!doctype html>
<html>
<head>

    <!--<meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />-->
    <meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="node_modules/angular-carousel/dist/angular-carousel.css">

    <link rel="stylesheet" href="/assets/css/main.css">

</head>
<div class="modal fade option" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <img src="https://placehold.it/350x150" class=".img-responsive" style="width:100%" alt="Image">
            </div>
            <div class="modal-body">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec lectus lorem, aliquet tincidunt erat at, faucibus lobortis massa. Etiam vitae elit euismod, tempor ligula non, elementum dui. Duis luctus leo vitae nibh sagittis sollicitudin.
                </p>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-success center-block" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>

<body>

<div class="container-fluid" style="align-content: center;">
  <div class="mainContainer">
    <div class="mainHeader">

      <!--THIS IS WHERE THE DAY / HOUR IS SHOWN--------------------------------------------->
      <div class="row">
        <p class="col-xs-6 currentDay">Day:</p>

        <p class="col-xs-6 currentHour"> Hour: <?php echo "testing"; ?></p>
      </div>
    </div>

    <!--THIS IS WHERE THE ROOM DROP-DOWN IS ------------------------------------------------>
    <div class="roomSelector">
      <p class="roomSelectorText">What room are you in?</p>
      <div class="btn-group">
        <button type="button" class="btn btn-default dropdown-toggle roomDropDown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Rooms <span class="caret"></span>
        </button>

        <ul class="dropdown-menu">
          <li><a href="#">Lunch Room</a></li>
          <li><a href="#">Secretary's Desk</a></li>
          <li><a href="#">IT Guy's Dungeon</a></li>
        </ul>

      </div>
    </div>

    <!--THIS IS WHERE THE BUTTONS FOR OPTIONS ARE SHOWN--------------------------------------------->
    <div class="btn-group-vertical mainBody">
      <button type="button" class="btn userOptions" data-toggle="modal" data-target=".option">Option #1</button>
      <button type="button" class="btn userOptions" data-toggle="modal" data-target=".option">Option #2</button>
      <button type="button" class="btn userOptions" data-toggle="modal" data-target=".option">Option #3</button>
    </div>

    <div class="mainFooter">
      <p class="userMinutes">You have ___ minutes left.</p>

      <!--THIS BUTTON TAKES YOU TO THE INFO PAGE FOR YOUR CHARACTER--------------------------------------------->
      <button class="btn infoButton" type="button" >Player Info</button>
      <!--THIS BUTTON SHOULD END YOUR TURN--------------------------------------------->
      <button class="btn btn-danger" type="button">End Turn</button>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>


</body>

</html>
