console.log('upload controller loaded');

app.controller('uploadController',
function($scope, $http, $location) {

  console.log($scope.uploadfile);
  Papa.parse($scope.uploadfile, {
    complete: function(results) {
      console.log("Finished:", results.data);
    }
  });

});
