// angular page routing

app.config(function($routeProvider){
  $routeProvider
    // home
    .when("/", {
      templateUrl: "app/components/start/startView.html",
      controller: "startController"
    })
    .when("/start", {
      templateUrl: "app/components/start/startView.html",
      controller: "startController"
    })
    // produkte
    .when("/produkte", {
      templateUrl: "app/components/product/productView.html",
      controller: "productController"
    })
    // produkte neu
    .when("/produkte/neu", {
      templateUrl: "app/components/product/productEdit.html",
      controller: "productController"
    })
    // produkte neu
    .when("/produkte/:ID/edit", {
      templateUrl: "app/components/product/productEdit.html",
      controller: "productController"
    })
    // wartungsvertraege
    .when("/wartungsvertraege", {
      templateUrl: "app/components/contract/contractView.html",
      controller: "contractController"
    });
});
