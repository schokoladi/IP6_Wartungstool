console.log('Product Controller loaded');

// Controller
// $scope, $http und $location werden 'injected', damit sie verwendet werden können
app.controller('productController',
function($scope, $http, $location, $routeParams, $rootScope, Product, Manufacturer, Article) {

  console.log($rootScope.authenticated);
  $scope.loading = true;

  // Message-Handling
  if($routeParams.message) {
    var split = $routeParams.message.split('~');
    // Types: 0 = error, 1 = info, 2 = success
    $scope.messageType = split[0];
    $scope.messageText = split[1];
    console.log($scope.messageType + ' ' + $scope.messageText);
  }

  var editId = $routeParams.ID;
  $scope.message = $routeParams.message;
  $scope.master = {};

  // Produkte via api aus der Datenbank holen
  getProducts = function() {
    Product.get()
    .success(function(response) {
      $scope.products = response;
      $scope.loading = false;
    });
  }

  // Hersteller via api aus der Datenbank holen
  getManufacturers = function() {
    Manufacturer.get()
    .success(function(response) {
      $scope.manufacturers = response;
      $scope.loading = false;
    });
  }
  // Hersteller via api aus der Datenbank holen
  showArticles = function(productId) {
    Article.product(productId)
    .success(function(response) {
      console.log('existiert');
      $scope.loading = false;
    })
    .error(function(response){
      console.log('nope');
    });
  }

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
      $location.path('/produkte/index/message/2~Produkt '
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
      $location.path('/produkte/index/message/1~Produkt '
      + productData.Name + ' editiert');
    });
  }

  // separate Funktion zum Speichern des Herstellers
  saveManufacturer = function(productData) {
    // Hersteller speichern wenn nicht leer
    Manufacturer.save(productData)
    .success(function(manufacturerData){
      console.log('successfully stored manufacturer');
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
    showArticles(id);
    
/*
    Product.destroy(id)
    .success(function(data) {
      $scope.loading = false;
      console.log('successfully deleted product');
      $location.path('/produkte/index/message/0~Produkt gelöscht');
    });*/
  };

  $scope.order = function(predicate) {
    $scope.reverse = ($scope.predicate === predicate) ? !$scope.reverse : false;
    $scope.predicate = predicate;
  };

  // Produkt editieren
  getProducts();
  getManufacturers();
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
    $scope.predicate = 'Artikelnummer';
    $scope.reverse = true;
  }

});
