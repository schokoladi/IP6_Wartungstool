/**
* Factories stellen Services zur Verfügung, welche über Funktionen aus diversen
* Controllern aufgerufen werden können.
* Die Factories rufen dabei über die REST-API die Backend-Funktionen auf, welche
* den Datenbankzugriff kontrollieren.
*/

// Artikel-Factory
app.factory('Article', function($http) {
  return {

    // Artikel speichern per POST
    save: function(articleData) {
      return $http({
        method: 'POST',
        url: '/api/articles',
        headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
        data: $.param(articleData)
      });
    },

    // Artikel anzeigen anhand einer WV-ID
    show: function(contractId) {
      return $http.get('/api/articles/' + contractId);
    },

    // Anzeigen anhand einer Produkt-ID
    product: function(productId) {
      return $http.get('/api/articles/' + productId);
    },

    // Artikel holen anhand einer ID
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
    },

    // Artikel löschen über API mit ID
    destroy : function(id) {
      return $http.delete('/api/articles/' + id);
    }
  }
});

// Wartungsvertrags-Factory
app.factory('Contract', function($http) {
  return {

    // Alle Wartungsverträge holen
    get: function() {
      return $http.get('/api/contracts');
    },

    // Wartungsvertragsdetails anzeigen anhand der ID
    show: function(showId) {
      return $http.get('/api/contracts/' + showId);
    },

    // Produkt editieren: Werte via API aus Datenbank holen
    edit: function(editId) {
      return $http.get('/api/contracts/' + editId + '/edit');
    },

    // Wartungsvertrag speichern per POST
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

// Stundenpool-Factory
app.factory('Stundenpool', function($http) {
  return {

    // Stundenpools anzeigen anhand einer WV-ID
    show: function(contractId) {
      return $http.get('api/stundenpools/' + contractId);
    },

    // Stundenpool bearbeiten
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

    // Stundenpool aktualisieren per PUT
    update: function(poolData) {
      return $http({
        method: 'PUT',
        url: '/api/stundenpools/' + poolData.ID,
        headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
        data: $.param(poolData)
      });
    },

    // Stundenpool löschen
    destroy : function(id) {
      return $http.delete('/api/stundenpools/' + id);
    }
  }
});

// Kunden-Factory
app.factory('Customer', function($http) {
  return {

    // Kunden anzeigen
    get: function() {
      return $http.get('/api/customers');
    }
  }
});

// Kontaktpersonen-Factory
app.factory('Contact', function($http) {
  return {

    // Alle Kontakpersonen holen
    get: function() {
      return $http.get('/api/contacts');
    },

    // Nur Kontaktpersonen eines Kunden holen
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

    // überprüfen, ob existiert: Wird nicht mehr benötigt dank UNIQUE-DB-Feld
    /*
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
      return $http({
      method:   'POST',
      url:      '/api/manufacturers/exists',
      headers:  {'Content-Type': 'application/x-www-form-urlencoded'},
      data:     $.param(productData)
    });
    }
    */
  }
});

// Produkt-Factory
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

    // Produkt eines bestimmten Herstellers und Produktnamen anzeigen
    reference: function(manufacturerId, productName) {
      return $http.get('/api/products/' + manufacturerId + '/' + productName);
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

// Währungen-Factory
app.factory('Currency', function($http) {
  return {

    // Währungen per API holen
    get: function() {
      return $http.get('/api/currencies');
    },

    // Bestimmte Währung anzeigen
    show: function(currencyId) {
      return $http.get('/api/currencies/' + currencyId);
    }
  }
});

// Wartungs--Factory
app.factory('Maintenance', function($http) {
  return {

    // Wartungen holen
    get: function() {
      return $http.get('/api/maintenances');
    }
  }
});

// Operation-Support-Factory
app.factory('Operationsupport', function($http) {
  return {

    // Alle Operation Supports holen
    get: function() {
      return $http.get('/api/operationsupports');
    },

    // bestimmten Operation Support holen anhand der ID
    show: function(maintenanceId) {
      return $http.get('/api/operationsupports/' + maintenanceId);
    }
  }
});

// OS-Stundenpool-Factory
app.factory('OS_Stundenpool', function($http) {
  return {

    // Alle Operation-Support-Stundenpools holen
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
