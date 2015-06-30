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
    // wartungsvertraege
    .when("/wartungsvertraege", {
      templateUrl: "app/components/contract/contractView.html",
      controller: "contractController"
    })
    // contract new
    .when("/wartungsvertraege/neu", {
      templateUrl: "app/components/contract/contractNewInfo.html",
      controller: "contractController"
    })
    // contract new article
    .when("/wartungsvertraege/neu/artikel", {
      templateUrl: "app/components/contract/contractNewArticle.html",
      controller: "contractController"
    })
    // contract new article
    .when("/wartungsvertraege/neu/stundenpool", {
      templateUrl: "app/components/contract/contractNewPool.html",
      controller: "contractController"
    });
});
