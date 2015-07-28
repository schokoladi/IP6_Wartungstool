//console.log('auth controller loaded');

// $routeparams statt $state
app.controller('authController', function($http, $location, $auth, $scope, $rootScope) {

  $scope.login = function() {
    //console.log('login...');
    var credentials = {
      username: $scope.auth.username,
      password: $scope.auth.password
    }

    $auth.login(credentials)
    .then(function() {
      // Return an $http request for the now authenticated
      // user so that we can flatten the promise chain
      return $http.get('api/authenticate/user');
      // Handle errors
    }, function(error) {
      var loginError = true;
      var loginErrorText = error.data.error;
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

  $scope.logout = function() {

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
