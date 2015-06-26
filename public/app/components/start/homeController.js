app.controller('homeController', function($scope, $http) {
  $http.get('/Produkte').success(function(response) {
    $scope.produkte = response.records;
  });
});
