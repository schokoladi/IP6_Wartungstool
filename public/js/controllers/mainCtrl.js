angular.module('mainCtrl', [])

// inject the Comment service into our controller
.controller('mainController', function($scope, $http, Produkt) {
    // object to hold all the data for the new s form
    $scope.produktData = {};

    // loading variable to show the spinning loading icon
    $scope.loading = true;

    // get all the comments first and bind it to the $scope.comments object
    // use the function we created in our service
    // GET ALL COMMENTS ==============
    Produkt.get().success(function(data) {
            $scope.produkte = data;
            $scope.loading = false;
        });

    // function to handle submitting the form
    // SAVE A COMMENT ================
    $scope.submitProdukt = function() {
        $scope.loading = true;

        // save the comment. pass in comment data from the form
        // use the function we created in our service
        Produkt.save($scope.produktData).success(function(data) {

                // if successful, we'll need to refresh the comment list
                Produkt.get().success(function(getData) {
                        $scope.produkte = getData;
                        $scope.loading = false;
                    });

            })
            .error(function(data) {
                console.log(data);
            });
    };

    // function to handle deleting a comment
    // DELETE A COMMENT ====================================================
    $scope.deleteProdukt = function(id) {
        $scope.loading = true;

        // use the function we created in our service
        Produkt.destroy(id).success(function(data) {

            // if successful, we'll need to refresh the comment list
            Produkt.get().success(function(getData) {
                $scope.produkte = getData;
                $scope.loading = false;
                });

        });
    };

});
