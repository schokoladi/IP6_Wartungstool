<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Test</title>

    <!-- CSS -->
    <!-- Bootstrap core CSS -->
    <link href="/public/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/public/css/custom.css" rel="stylesheet">

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.16/angular.min.js"></script> <!-- load angular -->

    <!-- ANGULAR -->
    <!-- all angular resources will be loaded from the /public folder -->
    <script src="/public/js/controllers/mainCtrl.js"></script> <!-- load our controller -->
    <script src="/public/js/services/produktService.js"></script> <!-- load our service -->
    <script src="/public/js/app.js"></script> <!-- load our application -->
</head>

<!-- declare our angular app and controller -->
<body class="container" ng-app="produktApp" ng-controller="mainController"> <div class="col-md-8 col-md-offset-2">

    <!-- PAGE TITLE =============================================== -->
    <div class="page-header">
        <h2>Laravel and Angular Single Page Application</h2>
        <h4>Test System</h4>
    </div>

    <!-- THE COMMENTS =============================================== -->
    <!-- hide these comments if the loading variable is true -->
    <div class="produkt" ng-hide="loading" ng-repeat="produkt in produkte">
        <h3>Produkt #{{ Produkt.ID }} <small>by {{ Produkt.Name }}</h3>
        <p>{{ Produkt.Artikelnummer }}</p>

        <p><a href="#" ng-click="deleteProdukt(produkt.id)" class="text-muted">Delete</a></p>
    </div>-->

</div>
</body>
</html>
