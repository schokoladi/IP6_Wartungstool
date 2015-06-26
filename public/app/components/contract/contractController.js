// Contract controller
app.controller('contractController', function($scope, $http) {
  console.log("Contract Controller loaded.");
  $http.get("/api/contracts").success(function(response) {
    $scope.contracts = response;
  });
});
