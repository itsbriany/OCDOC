'use strict';
angular.module('OfficeCrawler', ['ngRoute', 'angular-carousel'])

    .config(function ($routeProvider) {
        $routeProvider
            .when('/', {
                templateUrl: '../../views/main.html',
                controller: 'RouteCtrl'
            })
            .when('/profile', {
                templateUrl: '../../views/profile.html',
                controller: 'RouteCtrl'
            })
            .otherwise({
                redirectTo: '/'
            });
    });