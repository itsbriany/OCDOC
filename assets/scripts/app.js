'use strict';
angular.module('OfficeCrawler', ['ngRoute'])

    .config(function ($routeProvider) {
        $routeProvider
            .when('/', {
                templateUrl: '../../views/profile.html'
            })
            .otherwise({
                redirectTo: '../../views/profile.html'
            });
    });