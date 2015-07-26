//Directives

// Directive erstellt neues HTML-Attribut. bsp. <input name="Name" manufacturer>
// TODO !!! Dies ist nur ein Mockup leider.. :(
// Die Schnittstelle der API würde bestehen!
/*
app.directive('manufacturerAvailable', function($q, $timeout, Manufacturer) {
  return {
    // Kannst als Attribut oder Element verwendet werden. + Class -> 'AEC'
    restrict: 'AE',
    require:  'ngModel',
    link:     function($scope, elm, attrs, ctrl) {
      //var manufacturers =
      //var manufacturers = ['SBB', 'Compuware', 'Infoblox', 'ManageEngine'];
      var manufacturers = ['SBB', 'Compuware'];
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
*/
app.directive('fileReader', function($scope) {

  console.log($scope.file);
  Papa.parse($scope.file, {
    complete: function(results) {
      console.log("Finished:", results.data);
    }
  });

/*
  return {
    scope: {
      fileReader:"="
    },
    link: function(scope, element) {
      $(element).on('change', function(changeEvent) {
        var files = changeEvent.target.files;
        if (files.length) {
          var r = new FileReader();
          r.onload = function(e) {
              var contents = e.target.result;
              scope.$apply(function () {
                scope.fileReader = contents;
              });
          };

          r.readAsText(files[0]);
        }
      });
    }
  };
  */
});
