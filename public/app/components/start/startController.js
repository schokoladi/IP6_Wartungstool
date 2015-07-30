//console.log('start controller loaded');

// Controller für die Startseite, keine Funktionen benötigt
app.controller('startController', function($scope, $http, $rootScope) {
  console.log($rootScope.authenticated);
});
