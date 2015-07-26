console.log('contract controller loaded');

app.controller('contractController',
function($scope, $http, $location, $routeParams, Article, Contract, Customer, Contact, Manufacturer, Product, Currency, Maintenance, Operationsupport, Stundenpool, OS_Stundenpool) {

  $scope.loading = true;

  // ------ DEFINING VARIABLES ------
  var showId          = $routeParams.showId;
  var contractId      = $routeParams.contractId;
  var contractEditId  = $routeParams.contractEditId;
  var articleEditId   = $routeParams.articleEditId;
  var poolEditId      = $routeParams.poolEditId;
  $scope.showId       = showId;
  $scope.contractId   = contractId;
  $scope.message      = $routeParams.message;
  master = {};

  // ------ GET METHODS ------
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

  // ------ SHOW METHODS ------
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

  // ------ SCOPE FUNCTIONS ------

  /**
  *  blabla
  *
  *  @param   object
  *  @param
  *  @return
  */
  $scope.refreshInfo = function() {
    var customerId = $scope.contractData.Wartungsvertraege_Kunden_ID;
    showContacts(customerId);
  }

  /**
  *  blabla
  *
  *  @param   object
  *  @param
  *  @return
  */
  $scope.refreshProduct = function() {
    var manufacturerId = $scope.articleData.Hersteller_ID;
    //console.log('manid ' + manufacturerId);
    showProducts(manufacturerId);
  }

  /**
  *  blabla
  *
  *  @param   object
  *  @param
  *  @return
  */
  $scope.refreshOperationsupport = function() {
    var maintenanceId = $scope.articleData.Artikel_Maintenance_ID;
    //console.log('manid ' + manufacturerId);
    showOperationsupports(maintenanceId);
  }

  /**
  *  blabla
  *
  *  @param   object
  *  @param
  *  @return
  */
  $scope.reset = function() {
    $scope.contractData = angular.copy(master);
    $scope.articleData  = angular.copy(master);
    $scope.poolData     = angular.copy(master);
    $scope.loading = false;
  };

  // ------ FUNCTIONS ------
  saveContract = function(contractData) {
    Contract.save(contractData)
    .success(function(contractInfo) {
      $scope.loading = false;
      console.log('successfully saved contract');
      $location.path('/wartungsvertraege/artikel/neu/' + contractInfo.Contract.ID +
      '/message/Wartungsvertrag ' + contractInfo.Contract.Vertragsnummer + ' erstellt');
    });
  }
  // Produkt aktualisieren
  updateContract = function(contractData) {
    Contract.update(contractData)
    .success(function(data) {
      $scope.loading = false;
      console.log('successfully updated contract');
      // message string kann easy so übergeben werden
      $location.path('/wartungsvertraege/info/' + contractEditId +
      '/edit/message/Wartungsvertragsinfo bearbeitet');
    });
  }

  saveArticle = function(articleData) {
    Article.save(articleData)
    .success(function(data) {
      $scope.loading = false;
      console.log('successfully saved article');
      $location.path('/wartungsvertraege/artikel/neu/' + contractId +
      '/message/Artikel erfasst');
    });
  }
  updateArticle = function(articleData) {
    Article.update(articleData)
    .success(function(data) {
      $scope.loading = false;
      console.log('successfully updated article');
      $location.path('/wartungsvertraege/artikel/' + articleEditId +
      '/edit/' + contractId + '/message/Artikel bearbeitet');
    });
  }

  savePool = function(poolData) {
    Stundenpool.save(poolData)
    .success(function(data) {
      $scope.loading = false;
      console.log('successfully saved pool');
      $location.path('/wartungsvertraege/pool/neu/' + contractId +
      '/message/Stundenpool erfasst');
    });
  }
  updatePool = function(poolData) {
    Stundenpool.update(poolData)
    .success(function(data) {
      $scope.loading = false;
      console.log('successfully updated pool');
      $location.path('/wartungsvertraege/pool/' + poolEditId +
      '/edit/' + contractId + '/message/Stundenpool bearbeitet');
    });
  }

  /**
  * Überprüft, ob das übergebene Datum vor dem heutigen ist.
  * Gibt true zurück wenn ja, false wenn nicht
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

  // TODO: Wieso funktionierts nid
  checkPrices = function(price1, currency1, price2, currency2) {
    Currency.show(currency1)
    .success(function(response) {
      console.log(response.Kurs);
      var rate1 = response.Kurs;
    });
    Currency.show(currency2)
    .success(function(response) {
      console.log(response.Kurs);
      var rate2 = response.Kurs;
    });
    var val1 = price1 * rate1;
    var val2 = price2 * rate2;
    if(val1 > val2) {
      return true;
    }
    else {
      return false;
    }
  }
  //var price = checkPrices('100', '3', '200', '2');

  $scope.storeContract = function() {
    console.log('store' + $scope.contractData);
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

  $scope.storeArticle = function() {
    console.log('store: ' + $scope.articleData);
    $scope.articleData.Artikel_Wartungsvertraege_ID = contractId;
    // checkPrices($scope.contractData.EKP_Artikel, $scope.contractData.EKP_Artikel_Waehrungen_ID, $scope.contractData.VKP_Artikel, $scope.contractData.VKP_Artikel_Waehrungen_ID);
    if(articleEditId) {
      updateArticle($scope.articleData);
    }
    else {
      saveArticle($scope.articleData);
    }
  }

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

  // Produkt löschen
  $scope.deletePool = function(id) {
    // Produkt mit Factory-Funktion löschen
    Stundenpool.destroy(id)
    .success(function(data) {
      $scope.loading = false;
      console.log('successfully deleted pool');
      $location.path('/wartungsvertraege/pool/neu/' + contractId +
      '/message/Stundenpool gelöscht!');
    });
  }

  // Inhalte laden
  if(contractEditId || articleEditId || poolEditId) {
    $scope.formMethod = 'PUT';
    if(contractEditId) {
      getCustomers();
      getContacts();
      Contract.edit(contractEditId)
      .success(function(response) {
        //showContacts(response.Wartungsvertraege_Kunden_ID);
        $scope.contractData = response;
        // TODO: Bug, kann nicht beschränkte Anzahl Kontakte laden + ausgewählt
        //showContacts($scope.contractData.Wartungsvertraege_Kunden_ID);
        $scope.loading = false;
      });
    }
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
  else {
    $scope.formMethod = 'POST';
    if(showId) {
      showContracts(showId);
    }
    else {
      getCustomers();
      getProducts();
      getManufacturers();
      getCurrencies();
      getMaintenances();
      getOperationsupports();
      showArticles(contractId);
      showStundenpools(contractId);
    }
  }

});
