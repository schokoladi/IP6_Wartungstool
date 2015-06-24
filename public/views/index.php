<!-- Dokument muss index.php heissen, Laravel-Richtlinie -->
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- disable scrolling on mobile -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="favicon.ico">

  <title>IP6 Wartungstool</title>

  <!-- Bootstrap core CSS -->
  <link href="styles/bootstrap.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="styles/custom.css" rel="stylesheet">

  <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
  <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
  <!-- <script src="../../assets/js/ie-emulation-modes-warning.js"></script> -->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<!-- controller wird erst in ng-view file defchroiniert -->
<body ng-app="wartungstoolApp">

  <div ng-include='"templates/navbar.html"'></div>
  <div class="container">
    <div class="row">
      <!-- medium device (Desktop) column -->
      <!--<div ng-include='"views/produkte.html"'></div>-->
      <!-- $routeProvider -->
      <div ng-view></div>
    </div>

  </div>

  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <!-- <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> -->

  <!-- note jquery tag has to go before boostrap -->
  <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.16/angular.min.js"></script> <!-- load angular -->
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.16/angular-route.min.js"></script>

  <!-- ANGULAR -->
  <!-- all angular resources will be loaded from the /public folder -->

  <!--<script src="js/controllers/produktController.js"></script>
  <script src="js/controllers/wartungsvertragController.js"></script>
  <script src="js/controllers/homeController.js"></script>-->

  <!-- <script src="js/services/produktService.js"></script> -->
  <script src="js/app.js"></script> <!-- load our application -->

  <!--<script src="js/jquery-scrolltofixed-min.js" type="text/javascript"></script>
  <script src="js/custom.js"></script>-->
  <!--<script>
  $(document).ready(function() {
    var stickyNavTop = $('.sticky-top').offset().top;

    var stickyNav = function(){
      var scrollTop = $(window).scrollTop();

      if (scrollTop > stickyNavTop) {
        $('.sticky-top').addClass('sticky');
      } else {
        $('.sticky-top').removeClass('sticky');
      }
    };

    stickyNav();

    $(window).scroll(function() {
      stickyNav();
    });
  });
</script>-->
</body>
</html>
