console.log('contract controller loaded');

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

    /*
    // Produkt editieren: Werte via API aus Datenbank holen
    edit : function(editId) {
    return $http.get('/api/contracts/' + editId + '/edit');
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
*/

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

app.controller('contractController', function($scope, $http, $location, $routeParams, Contract, Customer, Contact) {

  $scope.loading = true;
  var showId = $routeParams.showId;
  var editId = $routeParams.editId;
  $scope.message = $routeParams.message;
  $scope.master = {};

  // Wartungsvertraege via api aus der Datenbank holen
  Contract.get()
  .success(function(response) {
    $scope.contracts = response;
    $scope.loading = false;
  });

  Customer.get()
  .success(function(response){
    $scope.customers = response;
    $scope.loading = false;
  });

  $scope.update = function() {
    var customerId = $scope.contractData.Wartungsvertraege_Kunden_ID;
    Contact.show(customerId)
    .success(function(response){
      $scope.contacts = response;
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

  /*
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
saveManufacturer = function(productData){
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
*/

});
