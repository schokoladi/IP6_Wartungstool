// controller for start page

app.controller('startController', function($scope, $http) {
  console.log("Start Controller loaded.");
  $http.get('/api/start').success(function(response) {
    $scope.produkte = response;
  });
});
