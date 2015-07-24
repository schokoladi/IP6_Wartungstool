//Directives

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
