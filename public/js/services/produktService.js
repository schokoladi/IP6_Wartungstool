// Angularmodul
angular.module('produktService', [])

.factory('Produkt', function($http) {

    return {
        // get all the comments
        // Hier wird via routing die index()-Funktion des ProduktControllers aufgerufen
        get : function() {
            return $http.get('/Produkte');
        },

        // save a comment (pass in comment data)
        save : function(produktData) {
            return $http({
                method: 'POST',
                url: '/Produkte',
                headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                data: $.param(produktData)
            });
        },

        // destroy a comment
        // Method: DELETE -> destroy()-Funktion wird aufgerufen
        destroy : function(id) {
            return $http.delete('/Produkte/' + id);
        }
    }

});
