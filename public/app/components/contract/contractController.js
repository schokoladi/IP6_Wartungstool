//console.log('contract controller loaded');

/**
* Der contractController verwaltet des ganzen Wartungsverträge-Bereich.
* Alle Zugriffe auf das Backend via API werden hier definiert.
*/
app.controller('contractController',
function($scope, $http, $location, $routeParams, $rootScope, Article, Contract,
  Customer, Contact, Manufacturer, Product, Currency, Maintenance, Operationsupport,
  Stundenpool, OS_Stundenpool) {

    //console.log($rootScope.authenticated);
    $scope.loading = true;

    // Message-Handling für die Message-Box
    if($routeParams.messageType && $routeParams.messageText) {
      $scope.messageType = $routeParams.messageType;
      $scope.messageText = $routeParams.messageText;
    }

    // ------ Variablendeklaration ------
    var showId          = $routeParams.showId;
    var contractId      = $routeParams.contractId;
    var contractEditId  = $routeParams.contractEditId;
    var articleEditId   = $routeParams.articleEditId;
    var poolEditId      = $routeParams.poolEditId;
    $scope.showId       = showId;
    $scope.contractId   = contractId;
    $scope.contractEditId = contractEditId;
    master = {};

    // ------ GET-Methoden ------
    
    getContracts = function() {
      Contract.get()
      .success(function(response) {
        $scope.contracts = response;
        $scope.loading = false;
      });
    }
    getCustomers = function() {
      Customer.get()
      .success(function(response) {
        $scope.customers = response;
        $scope.loading = false;
      });
    }
    getContacts = function() {
      Contact.get()
      .success(function(response) {
        $scope.contacts = response;
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
    getProducts = function() {
      Product.get()
      .success(function(response) {
        $scope.products = response;
        $scope.loading = false;
      });
    }
    getCurrencies = function() {
      Currency.get()
      .success(function(response) {
        $scope.currencies = response;
        $scope.loading = false;
      });
    }
    getMaintenances = function() {
      Maintenance.get()
      .success(function(response) {
        $scope.maintenances = response;
        $scope.loading = false;
      });
    }
    getOperationsupports = function() {
      Operationsupport.get()
      .success(function(response) {
        $scope.operationsupports = response;
        $scope.loading = false;
      });
    }
    getOSStundenpools = function() {
      OS_Stundenpool.get()
      .success(function(response) {
        $scope.ospools = response;
        $scope.loading = false;
      });
    }

    // ------ SHOW-Methoden ------

    showContracts = function(id) {
      Contract.show(id)
      .success(function(response) {
        $scope.contractData = response;
        $scope.loading = false;
      });
    }
    showContacts = function(id) {
      Contact.show(id)
      .success(function(response) {
        $scope.contacts = response;
        $scope.loading = false;
      });
    }
    showProducts = function(id) {
      Product.show(id)
      .success(function(response) {
        $scope.products = response;
        $scope.loading = false;
      });
    }
    // Referencen wird für die Einschränkung eines Produkts anhand von Hersteller-ID
    // und Produktname verwendet, damit nur noch die Aritkelnummer übrig bleibt
    showReferences = function(manufacturerId, productName) {
      Product.reference(manufacturerId, productName)
      .success(function(response) {
        $scope.references = response;
        $scope.loading = false;
      });
    }
    showArticles = function(id) {
      Article.show(id)
      .success(function(response) {
        $scope.articles = response;
        $scope.loading = false;
      });
    }
    showOperationsupports = function(id) {
      Operationsupport.show(id)
      .success(function(response) {
        $scope.operationsupports = response;
        $scope.loading = false;
      });
    }
    showStundenpools = function(id) {
      Stundenpool.show(id)
      .success(function(response) {
        $scope.pools = response;
        $scope.loading = false;
      });
    }

    // Falls eine WV-ID werden die notwendigen Informationen geladen
    if(contractId) {
      Contract.show(contractId)
      .success(function(response) {
        $scope.contractData = response;
        Product.get()
        .success(function(response) {
          $scope.products = response;
          $scope.loading = false;
        });
      });
    }

    // ------ Funktionen ------

    /**
    * Speichert einen Wartungsvertrag mit den eingegeben Formulardaten und leitet
    * auf die Artikelerfassungs-Seite mit einer Message weiter.
    *
    * @param  Object  Objekt mit den Formulardaten
    * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
    */
    saveContract = function(contractData) {
      Contract.save(contractData)
      .success(function(contractInfo) {
        $scope.loading = false;
        console.log('successfully saved contract');
        $location.path('/wartungsvertraege/artikel/neu/' + contractInfo.Contract.ID +
        '/msgtype/2/msgtext/Wartungsvertrag ' + contractInfo.Contract.Vertragsnummer + ' erstellt');
      });
    }

    /**
    * Aktualisiert die Wartungsvertrags-Infos anhand der Formulardaten und leitet
    * auf die Artikelerfassungs-Seite mit einer Message weiter.
    *
    * @param  Object  Objekt mit den Formulardaten
    * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
    */
    updateContract = function(contractData) {
      Contract.update(contractData)
      .success(function(data) {
        $scope.loading = false;
        //console.log('successfully updated contract');
        $location.path('/wartungsvertraege/artikel/neu/' + contractEditId +
        '/msgtype/1/msgtext/Wartungsvertragsinfo bearbeitet');
      });
    }

    /**
    * Speichert einen Wartungsvertragsartikel anhand der übergebenen Formulardaten
    * und gibt eine Message zurück via URL.
    *
    * @param  Object  Objekt mit den Formulardaten
    * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
    */
    saveArticle = function(articleData) {
      Article.save(articleData)
      .success(function(data) {
        $scope.loading = false;
        //console.log('successfully saved article');
        $location.path('/wartungsvertraege/artikel/neu/' + contractId +
        '/msgtype/2/msgtext/Artikel erfasst');
      });
    }

    /**
    * Aktualisiert einen Wartungsvertragsartikel anhand der eingebenen Formulardaten
    * und gibt eine entsprechende Message zurück
    *
    * @param  Object  Objekt mit den Formulardaten
    * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
    */
    updateArticle = function(articleData) {
      Article.update(articleData)
      .success(function(data) {
        $scope.loading = false;
        //console.log('successfully updated article');
        $location.path('/wartungsvertraege/artikel/' + articleEditId +
        '/edit/' + contractId + '/msgtype/1/msgtext/Artikel bearbeitet');
      });
    }

    /**
    * Speichert einen Stundenpool anhand der eingegeben Formulardaten und gibt eine
    * Message zurück via URL.
    *
    * @param  Object  Objekt mit den Formulardaten
    * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
    */
    savePool = function(poolData) {
      Stundenpool.save(poolData)
      .success(function(data) {
        $scope.loading = false;
        console.log('successfully saved pool');
        $location.path('/wartungsvertraege/pool/neu/' + contractId +
        '/msgtype/2/msgtext/Stundenpool erfasst');
      });
    }

    /**
    * Aktualisiert einen Stundenpool anhand der übergebenen Formulardaten und gibt
    * eine Message zurück.
    *
    * @param  Object  Objekt mit den Formulardaten
    * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
    */
    updatePool = function(poolData) {
      Stundenpool.update(poolData)
      .success(function(data) {
        $scope.loading = false;
        //console.log('successfully updated pool');
        $location.path('/wartungsvertraege/pool/' + poolEditId +
        '/edit/' + contractId + '/msgtype/1/msgtext/Stundenpool bearbeitet');
      });
    }

    /**
    * Überprüft, ob das übergebene Datum vor dem heutigen ist.
    * Gibt true zurück wenn ja, false wenn nicht.
    * TODO: Diese Funktion ist nicht abgeschlossen und wird nicht verwendet
    *
    * @param    string    Datum
    * @return   boolean
    * @author   Dominik Schoch
    */
    checkDateNow = function(inputDate) {
      var dateNow = new Date();
      var options = {day: '2-digit', month: '2-digit', year: 'numeric'};
      console.log(dateNow.toLocaleDateString('{"format":"yyyy-MM-dd"}'));
    }

    // ------ SCOPE-Funktionen ------
    // Scope-Funktionen sind von den HTML-Seiten aus aufrufbar

    /**
    * Aktualisiert die Kontaktpersonen anhand der ausgewählten Kunden-ID und ruft
    * dafür showContact() auf.
    *
    * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
    */
    $scope.refreshInfo = function() {
      var customerId = $scope.contractData.Wartungsvertraege_Kunden_ID;
      showContacts(customerId);
    }

    /**
    * Schränk die Artikelnummer-Auswahl ein, Nachdem der Hersteller und das Produkt
    * ausgewählt worden sind anhand der Methode showReferences
    *
    * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
    */
    $scope.refreshProducts = function() {
      var manufacturerId = $scope.articleData.Hersteller_ID;
      showProducts(manufacturerId);
      for(var prop in $scope.products) {
        if($scope.products[prop].ID == $scope.articleData.Artikel_Produkte_ID) {
          var productName = $scope.products[prop].Name;
          break;
        }
      }
      showReferences(manufacturerId, productName);
    }

    /**
    * Schränkt den Operation Support anhand der ausgewählten Maintenance ein mit der
    * Methode showOperationsupport().
    *
    * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
    */
    $scope.refreshOperationsupport = function() {
      var maintenanceId = $scope.articleData.Artikel_Maintenance_ID;
      showOperationsupports(maintenanceId);
    }

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

    /**
    * Setzt die Formulardaten zurück und überschreibt dabei die Input-Felder.
    *
    * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
    */
    $scope.reset = function() {
      $scope.articleData  = angular.copy(master);
      $scope.poolData     = angular.copy(master);
      $scope.loading      = false;
    };

    /**
    * Formularfunktion zum Speichern eines Wartungsvertrags
    */
    $scope.storeContract = function() {
      //console.log('store' + $scope.contractData);
      if(!$scope.contractData.Inaktiv) {
        $scope.contractData.Inaktiv = false;
      }
      // wenn eine id mitgegeben wird, update die bestehenden WV-Informationen
      if(contractEditId) {
        updateContract($scope.contractData);
      }
      else {
        saveContract($scope.contractData);
      }
    }

    /**
    * Formularfunktion zum Speichern eines Wartungsvertragsartikels
    */
    $scope.storeArticle = function() {
      $scope.articleData.Artikel_Wartungsvertraege_ID = contractId;
      if(articleEditId) {
        updateArticle($scope.articleData);
      }
      else {
        saveArticle($scope.articleData);
      }
    }

    /**
    * Formularfunktion zum Löschen eines Wartungsvertragsartikels
    *
    * @param  integer   Wartungsvertragsartikel-ID
    * @param  string    location, zu welcher weitergeleitet werden soll
    * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
    */
    $scope.deleteArticle = function(id, location) {
      Article.destroy(id)
      .success(function(data) {
        $scope.loading = false;
        console.log('successfully deleted article');
        // location entweder 'index' oder 'artikel/neu/:contractId'
        if(location == 'neu') {
          location = 'artikel/neu/' + contractId;
        }
        $location.path('/wartungsvertraege/' + location +
        '/msgtype/0/msgtext/Artikel gelöscht!');
      });
    }

    /**
    * Formularfunktion zum Speichern eines Stundenpools
    */
    $scope.storePool = function() {
      console.log('store: ' + $scope.poolData);
      $scope.poolData.Stundenpools_Wartungsvertraege_ID = contractId;
      if(poolEditId) {
        updatePool($scope.poolData);
      }
      else {
        savePool($scope.poolData);
      }
    }

    /**
    * Formularfunktion zum Löschen eines Stundenpools
    *
    * @param  integer   Stundenpool-ID
    * @param  string    location, zu welcher weitergeleitet werden soll
    * @author Dominik Schoch <dominik.schoch@students.fhnw.ch>
    */
    $scope.deletePool = function(id, location) {
      Stundenpool.destroy(id)
      .success(function(data) {
        $scope.loading = false;
        console.log('successfully deleted pool');
        // location entweder 'index' oder 'pool/neu/:contractId'
        if(location == 'neu') {
          location = 'pool/neu/' + contractId;
        }
        $location.path('/wartungsvertraege/' + location +
        '/msgtype/0/msgtext/Stundenpool gelöscht!');
      });
    }

    // Unterscheidung, ob auf einer Bearbeitungsseite oder nicht
    // Setzen der Formularmethode
    if(contractEditId || articleEditId || poolEditId) {
      $scope.formMethod = 'PUT';
      if(contractEditId) {
        getCustomers();
        getContacts();
        Contract.edit(contractEditId)
        .success(function(response) {
          $scope.contractData = response;
          // TODO: Bug, kann nicht beschränkte Anzahl Kontakte laden + ausgewählt
          //showContacts($scope.contractData.Wartungsvertraege_Kunden_ID);
          $scope.loading = false;
        });
      }
      // Artikelinfo-Seite
      else if(articleEditId) {
        //console.log(contractId);
        getProducts();
        getManufacturers();
        getCurrencies();
        getMaintenances();
        getOperationsupports();
        showArticles(contractId);
        showStundenpools(contractId);
        Article.edit(articleEditId)
        .success(function(response) {
          $scope.articleData = response;
          $scope.loading = false;
        });
      }
      // Stundenpool-Seite
      else if(poolEditId) {
        getOSStundenpools();
        getCurrencies();
        showArticles(contractId);
        showStundenpools(contractId);
        Stundenpool.edit(poolEditId)
        .success(function(response) {
          $scope.poolData = response;
          $scope.loading = false;
        });
      }
    }
    // Formular-Methode POST, wenn neu erfasst wird
    else {
      $scope.formMethod = 'POST';
      if(showId) {
        showContracts(showId);
      }
      else {
        getContracts();
        getCustomers();
        getProducts();
        getManufacturers();
        getCurrencies();
        getMaintenances();
        getOperationsupports();
        getOSStundenpools();
        if(contractId) {
          showArticles(contractId);
          showStundenpools(contractId);
        }
      }
    }

  });
