console.log('contract controller loaded');

app.factory('Article', function($http) {
  return {

    // Artikel speichern
    save: function(articleData) {
      return $http({
        method: 'POST',
        url: '/api/articles',
        headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
        data: $.param(articleData)
      });
    },

    show: function(contractId) {
      return $http.get('/api/articles/' + contractId);
    }
  }
});

app.factory('Contract', function($http) {
  return {
    //
    get: function() {
      return $http.get('/api/contracts');
    },

    // Produkt speichern
    save: function(contractData) {
      return $http({
        method: 'POST',
        url: '/api/contracts',
        headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
        data: $.param(contractData)
      });
    },

    // Wartungsvertragsdetails anzeigen
    show: function(showId) {
      return $http.get('/api/contracts/' + showId);
    },

    // Produkt löschen
    destroy : function(id) {
      return $http.delete('/api/contracts/' + id);
    }
  }
});

app.factory('Customer', function($http) {
  return {
    //
    get: function() {
      return $http.get('/api/customers');
    }
  }
});

app.factory('Contact', function($http) {
  return {
    get: function() {
      return $http.get('/api/contacts');
    },
    show: function(customerId) {
      return $http.get('/api/contacts/' + customerId);
    }
  }
});

app.factory('Manufacturer', function($http) {
  return {
    //
    get: function() {
      return $http.get('/api/manufacturers');
    }
  }
});

app.factory('Product', function($http) {
  return {
    get: function() {
      return $http.get('/api/products');
    }
  }
});

app.factory('Currency', function($http) {
  return {
    get: function() {
      return $http.get('/api/currencies');
    }
  }
});

app.factory('Maintenance', function($http) {
  return {
    get: function() {
      return $http.get('/api/maintenances');
    }
  }
});

app.factory('Operationsupport', function($http) {
  return {
    get: function() {
      return $http.get('/api/operationsupports');
    }
  }
})

app.controller('contractController', function($scope, $http, $location, $routeParams,
  Article, Contract, Customer, Contact, Manufacturer, Product, Currency, Maintenance,
  Operationsupport) {

    $scope.loading = true;
    var showId = $routeParams.showId;
    var editId = $routeParams.editId;
    var contractId = $routeParams.contractId;
    $scope.message = $routeParams.message;
    $scope.master = {};

    // Wartungsvertraege via api aus der Datenbank holen
    Contract.get()
    .success(function(response) {
      $scope.contracts = response;
      $scope.loading = false;
    });

    Customer.get()
    .success(function(response) {
      $scope.customers = response;
      $scope.loading = false;
    });

    Manufacturer.get()
    .success(function(response) {
      $scope.manufacturers = response;
      $scope.loading = false;
    });

    Currency.get()
    .success(function(response) {
      $scope.currencies = response;
      $scope.loading = false;
    });

    Maintenance.get()
    .success(function(response) {
      $scope.maintenances = response;
      $scope.loading = false;
    });

    Article.show(contractId)
    .success(function(response) {
      $scope.articles = response;
      $scope.loading = false;
    });

    Operationsupport.get()
    .success(function(response) {
      $scope.operationsupports = response;
      $scope.loading = false;
    });

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

    $scope.infoUpdate = function() {
      var customerId = $scope.contractData.Wartungsvertraege_Kunden_ID;
      Contact.show(customerId)
      .success(function(response) {
        $scope.contacts = response;
        $scope.loading = false;
      });
    }

    $scope.productUpdate = function() {
      var manufacturerId = $scope.articleData.Hersteller_ID;
      //console.log('manid ' + manufacturerId);
      Product.show(manufacturerId)
      .success(function(response) {
        $scope.products = response;
        $scope.loading = false;
      });
    }

    // Produkt-Formular Handling
    $scope.reset = function() {
      $scope.contractData = angular.copy($scope.master);
      $scope.loading = false;
    };

    if(showId) {
      Contract.show(showId)
      .success(function(response) {
        $scope.contractData = response;
        $scope.loading = false;
      });
    }

    saveContract = function(contractData) {
      Contract.save(contractData)
      .success(function(contractInfo) {
        $scope.loading = false;
        console.log('successfully saved contract');
        $location.path('/wartungsvertraege/artikel/neu/' + contractInfo.Contract.ID +
        '/message/Wartungsvertrag ' + contractInfo.Contract.Vertragsnummer + ' erstellt');
      });
    }

    saveArticle = function(articleData) {
      Article.save(articleData)
      .success(function(data) {
        $scope.loading = false;
        console.log('successfully saved contract');
        $location.path('/wartungsvertraege/artikel/neu/' + contractId +
        '/message/Artikel erfasst');
      });
    }

    // Produkt editieren
    if(editId) {
      $scope.formMethod = 'PUT';
      Contract.edit(editId)
      .success(function(response) {
        $scope.contractData = response;
        $scope.loading = false;
      });
    }
    else {
      $scope.formMethod = 'POST';
    }

    $scope.storeContract = function() {
      console.log('store' + $scope.contractData);
      if(!$scope.contractData.Inaktiv) {
        $scope.contractData.Inaktiv = false;
      }
      // wenn eine id mitgegeben wird, update die bestehenden WV-Informationen
      if(editId) {
        updateContract($scope.contractData);
      }
      else {
        saveContract($scope.contractData);
      }
    }

    $scope.storeArticle = function() {
      console.log('store: ' + $scope.articleData);
      $scope.articleData.Artikel_Wartungsvertraege_ID = contractId;
      if(editId) {
        updateArticle($scope.articleData);
      }
      else {
        saveArticle($scope.articleData);
      }
    }

  });
