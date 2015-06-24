// define angular application
var app = angular.module('wartungstoolApp', ['ngRoute']);

app.config(function($routeProvider){
  $routeProvider
    // home
    .when("/", {
      templateUrl: "views/home.html",
      controller: "homeController"
    })
    // produkte
    .when("/produkte", {
      templateUrl: "views/produkte.html",
      controller: "produktController"
    })
    // wartungsvertraege
    .when("/wartungsvertraege", {
      templateUrl: "views/wartungsvertraege.html",
      controller: "wartungsvertragController"
    });
});

app.controller('homeController', function($scope, $http) {
  console.log("Page Controller ok.");
  $http.get('/Produkte').success(function(response) {
    $scope.produkte = response.records;
  });
});

app.controller('produktController', function($scope, $http) {
  console.log("produktController loaded.");
  $http.get("/Produkte").success(function(response) {
    $scope.produkte = response;
  });
});

app.controller('wartungsvertragController', function($scope, $http) {
  console.log("wartungsvertragController loaded.");
  $http.get("/Wartungsvertraege").success(function(response) {
    $scope.wartungsvertraege = response;
  });
});


/*
app.controller('homeController', function() {
  var self = this;
  self.message = "The app routing is working!";
});
*/
//var app = angular.module('wartungstoolApp', ['mainCtrl', 'produktService']);
/**
* Main AngularJS Web Application
*/
//var app = angular.module('wartungstoolApp', ['ngRoute']);
