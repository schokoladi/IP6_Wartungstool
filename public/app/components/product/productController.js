//console.log('product controller loaded');

/**
* Der productController verwaltet die Anzeige, Erfassung und Bearbeitung der Produkte
*/
app.controller('productController',
function($scope, $http, $location, $routeParams, $rootScope, Product, Manufacturer, Article) {

  //console.log($rootScope.authenticated);
  $scope.loading = true;

  // Message-Handling
  if($routeParams.messageType && $routeParams.messageText) {
    $scope.messageType = $routeParams.messageType;
    $scope.messageText = $routeParams.messageText;
  }

  // Variablendeklaration
  var editId = $routeParams.editId;
  $scope.master = {};

  // ------ GET-Methoden ------

  getProducts = function() {
    Product.get()
    .success(function(response) {
      //console.log(response);
      $scope.products = response;
      $scope.loading = false;
    });
  }
  getManufacturers = function() {
    Manufacturer.get()
    .success(function(response) {
      $scope.manufacturers = response;
      $scope.loading = false;
    });
  }

  // ------ Funktionen ------

  /**
  * Kontrolliert, ob das Produkt noch einem Wartungsvertragsartikel zugeordnet ist.
  * TODO: Diese Funktion funktioniert nicht zuverlässig. Bei gewissen Produkten
  * greift sie nicht und es wird ein Backend-Fehler zurückgegeben.
  *
  * @param  integer  Produkt-ID
  * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
  */
  checkArticles = function(productId) {
    Article.product(productId)
    .success(function(response) {
      //console.log(response);
      // Überprüfen, ob das Array 'articles' Werte enthält
      if (response.length > 0) {
        $location.path('/produkte/index/msgtype/1/msgtext/Produkt ist noch einem Wartungsvertrag zugewiesen!');
      }
      else {
        Product.destroy(productId)
        .success(function(data) {
          $scope.loading = false;
          //console.log('successfully deleted product');
          $location.path('/produkte/index/msgtype/0/msgtext/Produkt gelöscht');
        });
      }
    });
  }

  /**
  * Speichert ein Pordukt mit den übergebenen Formulardaten.
  *
  * @param  Object  Objekt mit den Formulardaten
  * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
  */
  saveProduct = function(productData) {
    Product.save(productData)
    .success(function(data) {
      $scope.loading = false;
      //console.log('successfully stored product');
      $location.path('/produkte/index/msgtype/2/msgtext/Produkt '
      + productData.Name + ' erstellt');
    });
  }

  /**
  * Aktualisiert ein Produkt und gibt eine Message zurück
  *
  * @param  Object  Objekt mit den Formulardaten
  * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
  */
  updateProduct = function(productData) {
    Product.update(productData)
    .success(function(data) {
      $scope.loading = false;
      //console.log('successfully updated product');
      $location.path('/produkte/index/msgtype/1/msgtext/Produkt '
      + productData.Name + ' editiert');
    });
  }

  /**
  * Speichert einen neuen Hersteller und übergibt dessen ID dem zu speichernden
  * oder updatenden Produkt.
  *
  * @param  Object  Objekt mit den Formulardaten
  * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
  */
  saveManufacturer = function(productData) {
    Manufacturer.save(productData)
    .success(function(manufacturerData) {
      // ID des gespeicherten Herstellers Produkt übergeben
      $scope.productData.Produkte_Hersteller_ID = manufacturerData.Manufacturer.ID;
      // Wenn Produkt editiert wird, updaten
      if(editId) {
        $scope.productData.ID = editId;
        updateProduct($scope.productData);
        // Bei neuem Produkt erstellen
      } else {
        saveProduct($scope.productData);
      }
    });
  }

  // ------ SCOPE-Funktionen ------
  // Scope-Funktionen sind von den HTML-Seiten aus aufrufbar

  /**
  * Setzt die Formulardaten zurück und überschreibt dabei die Input-Felder.
  *
  * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
  */
  $scope.reset = function() {
    $scope.productData = angular.copy($scope.master);
    $scope.loading = false;
  };

  /**
  * Funktion zum speichern oder aktualisieren eines Produkts.
  * Handhabt zusätzlich das Erstellen eines neuen Herstellers.
  *
  * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
  */
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

  /**
  * Formularfunktion zum Löschen eines Produkts und Kontrolle, ob das Produkt noch
  * in einem Wartungsvertragsartikel vorhanden ist.
  *
  * @param  integer   Produkt-ID
  * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
  */
  $scope.deleteProduct = function(id) {
    // Produkt kann nur gelöscht werden, wenn es in keinen Artikeln mehr vorhanden ist
    checkArticles(id);
  };

  /**
  * Handhabt das Sortieren der Tabelleninhalte anhand übergebener predicates.
  *
  * @param  predicate   Tabellenfeld, nach welchem sortiert werden soll
  * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
  */
  $scope.order = function(predicate) {
    $scope.reverse = ($scope.predicate === predicate) ? !$scope.reverse : false;
    $scope.predicate = predicate;
  };

  getProducts();
  getManufacturers();

  // Produkt editieren-Seite
  if(editId) {
    // Formularmethode für update definieren
    $scope.formMethod = 'PUT';
    Product.edit(editId)
    .success(function(response) {
      $scope.productData = response;
      $scope.loading = false;
    });
  }
  else {
    // Formularmethode für neu definieren
    $scope.formMethod = 'POST';
    $scope.predicate = 'Artikelnummer';
    $scope.reverse = true;
  }

});
