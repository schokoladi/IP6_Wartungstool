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
  <link href="assets/css/bootstrap.css" rel="stylesheet">
  <!-- Custom style -->
  <link href="assets/css/custom.css" rel="stylesheet">

</head>

<!-- app-body -->
<body ng-app="wartungstoolApp">

  <div ng-include='"app/shared/navbar/navbar.html"'></div>
  <div class="container">
    <div ng-view></div>
  </div>

  <!-- note jquery tag has to go before boostrap -->
  <!-- WARNING: jquery 1 instead of 2 used because of INTERNET EXPLORER support! -->
  <!-- jQuery v1.11.3 -->
  <script src="assets/libs/jquery.min.js"></script>

  <!-- Bootstrap v3.3.5 -->
  <script src="assets/libs/bootstrap.min.js"></script>

  <!-- AngularJS v1.3.16 -->
  <script src="assets/libs/angular.min.js"></script> <!-- load angular -->
  <script src="assets/libs/angular-route.min.js"></script> <!-- load angular routing module -->

  <!-- app specific JavaScript files -->
  <script src="app/app.module.js"></script> <!-- initiate the application -->
  <script src="app/app.routing.js"></script> <!-- load angular routings -->

  <script src="app/components/contract/contractController.js"></script>
  <script src="app/components/product/productController.js"></script>
  <script src="app/components/start/startController.js"></script>

</body>
</html>
