// Contract controller
app.controller('contractController', function($scope, $http) {
  console.log("Contract Controller loaded.");
  $http.get("/api/contracts").success(function(response) {
    $scope.contracts = response;
  })

  $http.get("/api/products").success(function(response) {
    $scope.products = response;
  });
});
