var app = angular.module('myApp', []);
app.controller('myCtrl', function($scope) {
    console.log("abcd");
    $scope.firstName= "John";
    $scope.lastName= "Doe";
});