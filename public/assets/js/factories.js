// Factories

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
    },
    edit: function(editId) {
      return $http.get('/api/articles/' + editId + '/edit');
    },
    // Artikel aktualisieren per POST
    update: function(articleData) {
      return $http({
        method: 'PUT',
        url: '/api/articles/' + articleData.ID,
        headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
        data: $.param(articleData)
      });
    }
  }
});

app.factory('Contract', function($http) {
  return {
    //
    get: function() {
      return $http.get('/api/contracts');
    },
    // Wartungsvertragsdetails anzeigen
    show: function(showId) {
      return $http.get('/api/contracts/' + showId);
    },
    // Produkt editieren: Werte via API aus Datenbank holen
    edit: function(editId) {
      return $http.get('/api/contracts/' + editId + '/edit');
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
    // Wartungsvertrag aktualisieren per PUT
    update: function(contractData) {
      return $http({
        method: 'PUT',
        url: '/api/contracts/' + contractData.ID,
        headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
        data: $.param(contractData)
      });
    },
    // Wartungsvertrag löschen
    destroy : function(id) {
      return $http.delete('/api/contracts/' + id);
    }
  }
});

app.factory('Stundenpool', function($http) {
  return {
    show: function(contractId) {
      return $http.get('api/stundenpools/' + contractId);
    },
    edit: function(editId) {
      return $http.get('/api/stundenpools/' + editId + '/edit');
    },
    // Stundenpool speichern per POST
    save: function(poolData) {
      return $http({
        method: 'POST',
        url: '/api/stundenpools',
        headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
        data: $.param(poolData)
      });
    },
    // Wartungsvertrag aktualisieren per PUT
    update: function(poolData) {
      return $http({
        method: 'PUT',
        url: '/api/stundenpools/' + poolData.ID,
        headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
        data: $.param(poolData)
      });
    },
    destroy : function(id) {
      return $http.delete('/api/stundenpools/' + id);
    }
  }
});

// Kunden-Factory
app.factory('Customer', function($http) {
  return {
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

// Hersteller-Factory
app.factory('Manufacturer', function($http) {
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
      .success(function(response) {
        deferred.reject();
      })
      .error(function(response) {
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

app.factory('Product', function($http) {
  return {
    // Produkte via API aus datenbank holen
    get: function() {
      return $http.get('/api/products');
    },

    // Produkt speichern per POST
    save: function(productData) {
      return $http({
        method: 'POST',
        url: '/api/products',
        headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
        data: $.param(productData)
      });
    },

    // Produkt eines bestimmten Herstellers anzeigen
    show: function(manufacturerId) {
      return $http.get('/api/products/' + manufacturerId);
    },

    // Produkt editieren: Werte via API aus Datenbank holen
    edit: function(editId) {
      return $http.get('/api/products/' + editId + '/edit');
    },

    // Produkt aktualisieren per POST
    update: function(productData) {
      return $http({
        method: 'PUT',
        url: '/api/products/' + productData.ID,
        headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
        data: $.param(productData)
      });
    },

    // Produkt löschen
    destroy: function(id) {
      return $http.delete('/api/products/' + id);
    }
  }
});

app.factory('Currency', function($http) {
  return {
    get: function() {
      return $http.get('/api/currencies');
    },
    show: function(currencyId) {
      return $http.get('/api/currencies/' + currencyId);
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
    },
    show: function(maintenanceId) {
      return $http.get('/api/operationsupports/' + maintenanceId);
    }
  }
});

app.factory('OS_Stundenpool', function($http) {
  return {
    get: function() {
      return $http.get('/api/osstundenpools');
    }
  }
});

/*
// Message-Factory
app.factory('Message', function($routeParams) {
  return {
    get: function() {
      
      var split = $routeParams.message.split('~');
      var msg.type = split[0];
      msg.message = split[1];

      return 'bla';
    }
  }
});
*/
