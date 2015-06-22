<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Wartungstool</title>

    <!-- CSS -->
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/custom.css" rel="stylesheet">

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.16/angular.min.js"></script> <!-- load angular -->

    <!-- ANGULAR -->
    <!-- all angular resources will be loaded from the /public folder -->
    <script src="js/controllers/mainCtrl.js"></script> <!-- load our controller -->
    <script src="js/services/produktService.js"></script> <!-- load our service -->
    <script src="js/app.js"></script> <!-- load our application -->
</head>

<!-- declare our angular app and controller -->
<body class="container" ng-app="produktApp" ng-controller="mainController">
  <div class="col-md-8 col-md-offset-2">

    <!-- PAGE TITLE =============================================== -->
    <div class="page-header">
        <h2>Laravel and Angular Single Page Application</h2>
        <h4>Test System</h4>
    </div>

    <!-- NEW COMMENT FORM -->
	<form ng-submit="submitProdukt()"> <!-- ng-submit will disable the default form action and use our function -->

		<!-- AUTHOR -->
		<div class="form-group">
			<input type="text" class="form-control input-sm" name="Name" ng-model="produktData.Name" placeholder="Name">
		</div>

		<!-- COMMENT TEXT -->
		<div class="form-group">
			<input type="text" class="form-control input-lg" name="Artikelnummer" ng-model="produktData.Artikelnummer" placeholder="Artikelnummer">
		</div>
    <div class="form-group">
			<input type="text" class="form-control input-lg" name="Hersteller_ID" ng-model="produktData.Hersteller_ID" placeholder="Hersteller">
		</div>

		<!-- SUBMIT BUTTON -->
		<div class="form-group text-right">
			<button type="submit" class="btn btn-primary btn-lg">Submit</button>
		</div>
	</form>

	<pre>
	{{ produktData }}
	</pre>

	<!-- LOADING ICON -->
	<!-- show loading icon if the loading variable is set to true -->
	<p class="text-center" ng-show="loading"><span class="fa fa-meh-o fa-5x fa-spin"></span></p>

    <!-- THE COMMENTS =============================================== -->
    <!-- hide these comments if the loading variable is true -->
    <div class="produkt" ng-hide="loading" ng-repeat="produkt in produkte">
        <h3>{{ produkt.Name }}</h3>
        <p>{{ produkt.Artikelnummer }}</p>

        <p><a href="#" ng-click="deleteProdukt(produkt.ID)" class="text-muted">Delete</a></p>
    </div>

</div>
</body>
</html>
