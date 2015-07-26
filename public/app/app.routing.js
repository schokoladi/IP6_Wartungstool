// angular page routing

app.config(function($routeProvider, $authProvider){

  $authProvider.loginUrl = '/api/authenticate';

  $routeProvider

  // --- START PAGES ---
  .when("/start", {
    templateUrl: "app/components/start/startView.html",
    controller: "startController"
  })

  // --- LOGIN ---
  .when("/login", {
    templateUrl: "app/components/login/loginView.html",
    controller: "authController"
  })
  // Die user-Seite wird erstellt, um über den Controller das Logout zu ermöglichen
  .when("/user", {
    templateUrl: "app/components/login/userView.html",
    controller: "authController"
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
  .when("/wartungsvertraege/index", {
    templateUrl: "app/components/contract/contractView.html",
    controller: "contractController"
  })
  // Detailsansicht eines Wartungsvertrags
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
  .when("/wartungsvertraege/info/:contractEditId/edit", {
    templateUrl: "app/components/contract/contractInfoEdit.html",
    controller: "contractController"
  })
  .when("/wartungsvertraege/info/:contractEditId/edit/message/:message", {
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
  .when("/wartungsvertraege/artikel/:articleEditId/edit/:contractId", {
    templateUrl: "app/components/contract/contractArticleEdit.html",
    controller: "contractController"
  })
  .when("/wartungsvertraege/artikel/:articleEditId/edit/:contractId/message/:message", {
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
  .when("/wartungsvertraege/pool/:poolEditId/edit/:contractId", {
    templateUrl: "app/components/contract/contractPoolEdit.html",
    controller: "contractController"
  })
  .when("/wartungsvertraege/pool/:poolEditId/edit/:contractId/message/:message", {
    templateUrl: "app/components/contract/contractPoolEdit.html",
    controller: "contractController"
  })

  // Upload
  .when("/upload", {
    templateUrl: "app/components/upload/uploadView.html",
    controller: "uploadController"
  });

  // Redirect to the auth state if any other states
  // are requested other than users
  //$urlRouterProvider.otherwise('/auth');
/*
  $stateProvider
  .state('auth', {
    url: '/auth',
    templateUrl: '../views/authView.html',
    controller: 'AuthController as auth'
  })
  .state('users', {
    url: '/users',
    templateUrl: '../views/userView.html',
    controller: 'UserController as user'
  });
  */

});
