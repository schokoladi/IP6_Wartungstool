// angular page routing

app.config(function($routeProvider){
  $routeProvider
    // home
    .when("/", {
      templateUrl: "app/components/start/startView.html",
      controller: "startController"
    })
    // produkte
    .when("/#/produkte", {
      templateUrl: "app/components/product/productView.html",
      controller: "productController"
    })
    // wartungsvertraege
    .when("/#/wartungsvertraege", {
      templateUrl: "app/components/contract/contractView.html",
      controller: "contractController"
    });
});
