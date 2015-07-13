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

    saveManufacturer : function(manufacturerData) {
      return $http({
        method: 'POST',
        url: '/api/manufacturers',
        headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
        data: $.param(manufacturerData)
      });
    },

    edit : function(editId) {
      return $http.get('/api/products/' + editId + '/edit');
    },

    // destroy a product
    destroy : function(id) {
      return $http.delete('/api/products/' + id);
    }
  }
});

// Controller
// $scope, $http und $location werden 'injected', damit sie verwendet werden können
app.controller('productController', function($scope, $http, $location, $routeParams, Product) {

  var editId = $routeParams.ID;

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

  // Produkt editieren
  Product.edit(editId)
  .success(function(response) {
    $scope.productData = response;
    $scope.loading = false;
  });

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
  $scope.deleteProduct = function(id) {
    $scope.loading = true;

    // use the function we created in our service
    Product.destroy(id)
    .success(function(data) {
      console.log("successfully deleted product");
      $location.path("/produkte"); // ok, TODO: also send message
      // bsp: ?msg="Erfolgreich erfasst"&status=ok
    });
  };

});
