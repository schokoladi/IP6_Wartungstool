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

    // Produkt editieren: Werte via API aus Datenbank holen
    edit : function(editId) {
      return $http.get('/api/products/' + editId + '/edit');
    },

    // Produkt aktualisieren
    update : function(productData) {
      // return $http.put('/api/products/' + updateId); nope
      return $http({
        method: 'PUT',
        url: '/api/products/' + productData.ID,
        headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
        data: $.param(productData)
      });
    },

    // Produkt löschen
    destroy : function(id) {
      return $http.delete('/api/products/' + id);
    }
  }
});

// Factory für Hersteller
app.factory('Manufacturer', function($q, $http) {
  return {
    // Hersteller aus Datenbank holen
    get: function() {
      return $http.get('/api/manufacturers');
    },
    // Hersteller speichern
    save: function(productData) {
      return $http({
        method:   'POST',
        url:      '/api/manufacturers',
        headers:  {'Content-Type': 'application/x-www-form-urlencoded'},
        data:     $.param(productData)
      });
    },
    // überprüfen, ob existiert
    exists: function(productData) {
      var deferred = $q.defer();
      $http.get('/api/manufacturers/exists' + productData)
      .success(function(response){
        deferred.reject();
      })
      .error(function(response){
        deferred.resolve();
      });
      return deferred.promise;
      /*
      return $http({
      method:   'POST',
      url:      '/api/manufacturers/exists',
      headers:  {'Content-Type': 'application/x-www-form-urlencoded'},
      data:     $.param(productData)
    });
    */
  }
}
});

// Directive erstellt neues HTML-Attribut. bsp. <input name="Name" manufacturer>
// TODO !!! Dies ist nur ein Mockup leider.. :(
// Die Schnittstelle der API würde bestehen!
app.directive('manufacturerAvailable', function($q, $timeout, Manufacturer) {
  return {
    // Kannst als Attribut oder Element verwendet werden. + Class -> 'AEC'
    restrict: 'AE',
    require:  'ngModel',
    link:     function($scope, elm, attrs, ctrl) {
      var manufacturers = ['SBB', 'Compuware', 'Infoblox', 'ManageEngine'];
      ctrl.$asyncValidators.unique = function(modelValue, viewValue) {
        if (ctrl.$isEmpty(modelValue)) {
          // consider empty model valid
          return $q.when();
        }
        var def = $q.defer();
        $timeout(function() {
          // Mock a delayed response
          if (manufacturers.indexOf(modelValue) === -1) {
            // The username is available
            def.resolve();
          } else {
            def.reject();
          }
        }, 200);
        return def.promise;
      }
    }
  }
});

// Controller
// $scope, $http und $location werden 'injected', damit sie verwendet werden können
app.controller('productController', function($scope, $http, $location, $routeParams, Product, Manufacturer) {

  $scope.loading = true;
  var editId = $routeParams.ID;
  $scope.message = $routeParams.message;
  $scope.master = {};

  // Produkte via api aus der Datenbank holen
  Product.get()
  .success(function(response) {
    $scope.products = response;
    $scope.loading = false;
  });

  // Hersteller via api aus der Datenbank holen
  Manufacturer.get()
  .success(function(response) {
    $scope.manufacturers = response;
    $scope.loading = false;
  });

  // Produkt-Formular Handling
  $scope.reset = function() {
    $scope.productData = angular.copy($scope.master);
    $scope.loading = false;
  };

  // Produkt erstellen
  saveProduct = function(productData) {
    Product.save(productData)
    .success(function(data) {
      $scope.loading = false;
      console.log('successfully stored product');
      // dafür wird $routeParams benötigt
      $location.path('/produkte/index/message/Produkt '
      + productData.Name + ' erstellt');
    });
  }

  // Produkt aktualisieren
  updateProduct = function(productData) {
    Product.update(productData)
    .success(function(data) {
      $scope.loading = false;
      console.log('successfully updated product');
      // message string kann easy so übergeben werden
      $location.path('/produkte/index/message/Produkt '
      + productData.Name + ' editiert');
    });
  }

  // separate Funktion zum Speichern des Herstellers
  saveManufacturer = function(productData) {
    // Hersteller speichern wenn nicht leer
    Manufacturer.save(productData)
    .success(function(manufacturerData){
      console.log('stored manufacturer');
      // ID des gespeicherten Herstellers Produkt übergeben
      $scope.productData.Produkte_Hersteller_ID = manufacturerData.Manufacturer.ID;
      // Wenn Produkt editiert wird, updaten
      if(editId) {
        updateProduct($scope.productData);
        // Bei neuem Produkt erstellen
      } else {
        saveProduct($scope.productData);
      }
    });
  }

  // Produkt editieren
  if(editId) {
    $scope.formMethod = 'PUT';
    Product.edit(editId)
    .success(function(response) {
      $scope.productData = response;
      $scope.loading = false;
    });
  }
  else {
    $scope.formMethod = 'POST';
  }

  // Produkt speichern
  $scope.storeProduct = function() {
    // Wenn eine id (/edit) mitgegeben wird, update das Produkt
    if(editId) {
      if($scope.productData.Hersteller && $scope.productData.Hersteller != '') {
        saveManufacturer($scope.productData);
      } else {
        updateProduct($scope.productData);
      }
    }
    // Wenn keine Id mitgegeben wurde, erstelle ein neues Produkt
    else {
      // Wenn ein neuer Hersteller angegeben wurde, speichere diesen
      if($scope.productData.Hersteller && $scope.productData.Hersteller != '') {
        saveManufacturer($scope.productData);
        // Andernfalls speichere nur das Produkt
      } else {
        saveProduct($scope.productData);
      }
    }
  };

  // Produkt löschen
  $scope.deleteProduct = function(id) {
    // Produkt mit Factory-Funktion löschen
    Product.destroy(id)
    .success(function(data) {
      $scope.loading = false;
      console.log('successfully deleted product');
      $location.path('/produkte/index/message/Produkt gelöscht');
    });
  };

});
