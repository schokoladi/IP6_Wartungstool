// angular page routing

app.config(function($routeProvider){
  $routeProvider

// --- START PAGES ---
  .when("/", {
    templateUrl: "app/components/start/startView.html",
    controller: "startController"
  })
  .when("/start", {
    templateUrl: "app/components/start/startView.html",
    controller: "startController"
  })

// --- PRODUKTE-ROUTING ---
  .when("/produkte/index", {
    templateUrl:  "app/components/product/productView.html",
    controller:   "productController"
  })
  .when("/produkte/index/message/:message", {
    templateUrl:  "app/components/product/productView.html",
    controller:   "productController"
  })
  .when("/produkte/index/start/:start/limit/:limit", {
    templateUrl:  "app/components/product/productView.html",
    controller:   "productController"
  })
  // produkte neu
  .when("/produkte/neu", {
    templateUrl:  "app/components/product/productEdit.html",
    controller:   "productController"
  })
  // produkte neu
  .when("/produkte/:ID/edit", {
    templateUrl:  "app/components/product/productEdit.html",
    controller:   "productController"
  })

// --- WARTUNGSVERTRAEGE-ROUTING ---
  .when("/wartungsvertraege", {
    templateUrl: "app/components/contract/contractView.html",
    controller: "contractController"
  })
  // Detailsansicht
  .when("/wartungsvertraege/detail/:showId", {
    templateUrl: "app/components/contract/contractDetail.html",
    controller: "contractController"
  })
  // Info
  .when("/wartungsvertraege/info/neu", {
    templateUrl: "app/components/contract/contractInfoEdit.html",
    controller: "contractController"
  })
  .when("/wartungsvertraege/info/neu/message/:message", {
    templateUrl: "app/components/contract/contractInfoEdit.html",
    controller: "contractController"
  })
  .when("/wartungsvertraege/info/:editId/edit", {
    templateUrl: "app/components/contract/contractInfoEdit.html",
    controller: "contractController"
  })
  .when("/wartungsvertraege/info/:editId/edit/message/:message", {
    templateUrl: "app/components/contract/contractInfoEdit.html",
    controller: "contractController"
  })
  // Artikel
  .when("/wartungsvertraege/artikel/neu/:contractId", {
    templateUrl: "app/components/contract/contractArticleEdit.html",
    controller: "contractController"
  })
  .when("/wartungsvertraege/artikel/neu/:contractId/message/:message", {
    templateUrl: "app/components/contract/contractArticleEdit.html",
    controller: "contractController"
  })
  .when("/wartungsvertraege/artikel/:editId/edit", {
    templateUrl: "app/components/contract/contractArticleEdit.html",
    controller: "contractController"
  })
  .when("/wartungsvertraege/artikel/:editId/edit/message/:message", {
    templateUrl: "app/components/contract/contractArticleEdit.html",
    controller: "contractController"
  })
  // Stundenpool
  .when("/wartungsvertraege/pool/neu/:contractId", {
    templateUrl: "app/components/contract/contractPoolEdit.html",
    controller: "contractController"
  })
  .when("/wartungsvertraege/pool/neu/:contractId/message/:message", {
    templateUrl: "app/components/contract/contractPoolEdit.html",
    controller: "contractController"
  })
  .when("/wartungsvertraege/pool/:editId/edit", {
    templateUrl: "app/components/contract/contractPoolEdit.html",
    controller: "contractController"
  })
  .when("/wartungsvertraege/pool/:editId/edit/message/:message", {
    templateUrl: "app/components/contract/contractPoolEdit.html",
    controller: "contractController"
  });

});
