<!doctype html>
<html>
  <head>

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
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

  <body ng-app="OfficeCrawler">

    <div class="container-fluid" style="align-content: center;" ng-view="">

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script src="node_modules/angular/angular.js"></script>
    <script src="node_modules/angular-route/angular-route.js"></script>
    <script src="node_modules/angular-touch/angular-touch.js"></script>
    <script src="node_modules/angular-carousel/dist/angular-carousel.js"></script>

    <script src="/assets/scripts/app.js"></script>

    <script src="assets/scripts/controllers/RouteController.js"></script>

  </body>

</html>
