'use strict';

angular.module('admin', ['admin.services','admin.filters'])
  .config(['$routeProvider', function($routeProvider) {
    $routeProvider
			.when('/list', {template: 'views/list.html', controller: ListCtrl})
			.when('/login', {template: 'views/login.html'})
			.otherwise({redirectTo: '/login'});
  },
]);