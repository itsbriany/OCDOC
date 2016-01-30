'use strict';
angular.module('OfficeCrawler').controller('RouteCtrl', function($scope, $location){

    $scope.go = function(path){
        $location.path(path);
    };

});