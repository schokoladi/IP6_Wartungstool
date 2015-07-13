console.log("Product Controller loaded.");

// Factory
app.factory('Product', function($http) {
  return {
    // get all the comments
    // Hier wird via routing die index()-Funktion des ProduktControllers aufgerufen
    // gibt JSON-String zurück
    get : function() {
      return $http.get('/api/products');
    },
    // Hersteller aus Datenbank holen
    getManufacturers : function() {
      return $http.get('/api/manufacturers');
    },
    // Produkt speichern
    save : function(productData) {
      return $http({
        method: 'POST',
        url: '/api/products',
        headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
        data: $.param(productData)
      });
    },
    // destroy a product
    destroy : function(id) {
      return $http.delete('/api/products' + id);
    }
  }
});

// Controller
// $scope, $http und $location werden 'injected', damit sie verwendet werden können
app.controller('productController', function($scope, $http, $location, Product) {

  // Produkte via api aus der Datenbank holen
  Product.get()
  .success(function(response) {
    $scope.products = response;
    $scope.loading = false;
  });
  // Hersteller via api aus der Datenbank holen
  Product.getManufacturers()
  .success(function(response){
    $scope.manufacturers = response;
  });
  // Produkt-Formular Handling
  $scope.master = {};
  $scope.reset = function() {
    $scope.product = angular.copy($scope.master);
  };
  $scope.reset();

  // Produkt speichern
  $scope.storeProduct = function() {
    $scope.loading = true;

    // save the comment. pass in comment data from the form
    // use the function we created in our service
    Product.save($scope.productData)
    .success(function(data) {
      console.log("successfully stored product");
      $location.path("/produkte"); // ok, TODO: also send message
      // bsp: ?msg="Erfolgreich erfasst"&status=ok

    })
    .error(function(data) {
      console.log(data);
    });
  };
});
/*
$scope.storeProduct = function() {
var data = $.param({
json: JSON.stringify({
articleNr: $scope.articleNr,
name: $scope.name,
manufacturer: $scope.manufacturer
})
});
$http.post("/api/products", data).success(function(data, status) {
$scope.master = data;
})
}*/

/*
app.controller('produktController', function($scope, $http, Produkt) {
// object to hold all the data for the new s form
$scope.produktData = {};

// loading variable to show the spinning loading icon
$scope.loading = true;

// get all the comments first and bind it to the $scope.comments object
// use the function we created in our service
// GET ALL COMMENTS ==============
Produkt.get().success(function(data) {
$scope.produkte = data;
$scope.loading = false;
});

// function to handle submitting the form
// SAVE A COMMENT ================
$scope.submitProdukt = function() {

$scope.loading = true;

// save the comment. pass in comment data from the form
// use the function we created in our service
Produkt.save($scope.produktData).success(function(data) {

// if successful, we'll need to refresh the comment list
Produkt.get().success(function(getData) {
$scope.produkte = getData;
$scope.loading = false;
});

})
.error(function(data) {
console.log(data);
});
};

// function to handle deleting a comment
// DELETE A COMMENT ====================================================
$scope.deleteProdukt = function(id) {
$scope.loading = true;

// use the function we created in our service
Produkt.destroy(id).success(function(data) {

// if successful, we'll need to refresh the comment list
Produkt.get().success(function(getData) {
$scope.produkte = getData;
$scope.loading = false;
});

});
};

});
*/
