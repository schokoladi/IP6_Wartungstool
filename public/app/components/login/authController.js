//console.log('auth controller loaded');

/**
* Der authController steuert das Login und kommuniziert mit den Satellizer-Funktionen.
* Dafür wurde eine Anleitung von Ryan Chenkie befolgt [1]
*
* [1] http://ryanchenkie.com/token-based-authentication-for-angularjs-and-laravel-apps/
*/
app.controller('authController', function($http, $location, $auth, $scope, $rootScope, $routeParams) {

  // Message-Variablendeklaration
  if($routeParams.messageType && $routeParams.messageText) {
    $scope.messageType = $routeParams.messageType;
    $scope.messageText = $routeParams.messageText;
  }

  // ------ SCOPE-Funktionen ------
  // Scope-Funktionen sind von den HTML-Seiten aus aufrufbar

  /**
  * Kontrolliert die übergebenen Login-Daten und setzt bei Erfolg die globalen
  * $rootScope-Variablen
  *
  * @author Ryan Chenkie
  */
  $scope.login = function() {
    // Login-Referenzen werden in ein Array gespeichert
    var credentials = {
      username: $scope.auth.username,
      password: $scope.auth.password
    }

    // Ruft die Login-Funktion der Satellizer-Bibliothek auf
    $auth.login(credentials)
    .then(function() {
      // Return an $http request for the now authenticated
      // user so that we can flatten the promise chain
      return $http.get('api/authenticate/user');
      // Handle errors
    }, function(error) {
      var loginError = true;
      var loginErrorText = error.data.error;

      // Weiterleitung mit einer Message
      $location.path('/login/msgtype/0/msgtext/Login fehlgeschlagen');

      // Because we returned the $http.get request in the $auth.login
      // promise, we can chain the next promise to the end here
    }).then(function(response) {
      // Stringify the returned data to prepare it
      // to go into local storage
      var user = response.data.user;
      // console.log(user.name);
      // Set the stringified user data into local storage
      localStorage.setItem('user', user);
      // The user's authenticated state gets flipped to
      // true so we can now show parts of the UI that rely
      // on the user being logged in
      $rootScope.authenticated = true;
      // Putting the user's data on $rootScope allows
      // us to access it anywhere across the app
      $rootScope.currentUser = user;
      // Everything worked out so we can now redirect to
      // the users state to view the data
      var roleSplit = user.role.split('~');
      //console.log(roleSplit);
      $rootScope.currentUserRoleId = roleSplit[0];
      $rootScope.currentUserRole = roleSplit[1];
      // 3; CEO
      if(roleSplit[0] == '3') {
        $location.path('/start');
      }
      else {
        $location.path('/wartungsvertraege/index');
      }
    });
  }

  /**
  * Das Logout setzt die globalen Variablen zurück
  *
  * @author Ryan Chenkie
  */
  $scope.logout = function() {

    // Ruft die Satellizer-Funktion auf
    $auth.logout().then(function() {
      // Remove the authenticated user from local storage
      localStorage.removeItem('user');
      // Flip authenticated to false so that we no longer
      // show UI elements dependant on the user being logged in
      $rootScope.authenticated = false;
      // Remove the current user info from rootscope
      $rootScope.currentUser = null;

      $location.path('/start');
    });
  }
  
});
