'use strict';
angular.module('OfficeCrawler', ['ngRoute', 'angular-carousel'])

    .config(function ($routeProvider) {
        $routeProvider
            .when('/', {
                templateUrl: '../../views/main.html'
            })
            .when('/profile', {
                templateUrl: '../../views/profile.html'
            })
            .otherwise({
                redirectTo: '/'
            });
    });