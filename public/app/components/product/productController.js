console.log("Product Controller loaded.");

// Factory für Produkte
app.factory('Product', function($http) {
  return {
    // get all the comments
    // Hier wird via routing die index()-Funktion des ProduktControllers aufgerufen
    // gibt JSON-String zurück
    get : function() {
      return $http.get('/api/products');
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

    edit : function(editId) {
      return $http.get('/api/products/' + editId + '/edit');
    },

    // destroy a product
    destroy : function(id) {
      return $http.delete('/api/products/' + id);
    }
  }
});

// Factory für Hersteller
app.factory('Manufacturer', function($http) {
  return {
    // Hersteller aus Datenbank holen
    get : function() {
      return $http.get('/api/manufacturers');
    },
    // Hersteller speichern
    save : function(productData) {
      return $http({
        method: 'POST',
        url: '/api/manufacturers',
        headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
        data: $.param(productData)
      });
    }
  }
});

// Controller
// $scope, $http und $location werden 'injected', damit sie verwendet werden können
app.controller('productController', function($scope, $http, $location, $routeParams, Product, Manufacturer) {

  var editId = $routeParams.ID;
  $scope.message = $routeParams.message;

  // Produkte via api aus der Datenbank holen
  Product.get()
  .success(function(response) {
    $scope.products = response;
    $scope.loading = false;
  });
  // Hersteller via api aus der Datenbank holen
  Manufacturer.get()
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
  if(editId) {
    Product.edit(editId)
    .success(function(response) {
      $scope.productData = response;
      $scope.loading = false;
    });
  }

  // separate Funktion zum Speichern des Herstellers für async
  saveManufacturer = function(productData){
    //var deferred = $q.defer();
    if(productData.Hersteller != '') {
      Manufacturer.save(productData)
      .success(function(manufacturerData){
        console.log("stored manufacturer");
        $scope.productData.Produkte_Hersteller_ID = manufacturerData.Manufacturer.ID;
        Product.save($scope.productData)
        .success(function(data) {
          console.log("successfully stored product");
          // dafür wird $routeParams benötigt
          $location.path("/produkte/index/message/das ging ja fix"); // ok, TODO: also send message
          // bsp: ?msg="Erfolgreich erfasst"&status=ok
        });
      });
    }
  }

  // Produkt speichern
  $scope.storeProduct = function() {
    $scope.loading = true;

    // Wenn ein neuer Hersteller angegeben wurde, speichere diesen
    if($scope.productData.Hersteller && $scope.productData.Hersteller != '' ) {
      saveManufacturer($scope.productData);
    // Andernfalls speichere nur das Produkt
    } else {
      Product.save($scope.productData)
      .success(function(data) {
        console.log("successfully stored product");
        // message string kann easy so übergeben werden
        $location.path("/produkte/index/message/das ging ja fix"); // ok, TODO: also send message
        // bsp: ?msg="Erfolgreich erfasst"&status=ok
      });
    }
  };

  $scope.deleteProduct = function(id) {
    $scope.loading = true;

    // use the function we created in our service
    Product.destroy(id)
    .success(function(data) {
      console.log("successfully deleted product");
      $location.path("/produkte/index/message/produkt gelöscht"); // ok, TODO: also send message
      // bsp: ?msg="Erfolgreich erfasst"&status=ok
    });
  };

});
