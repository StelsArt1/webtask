'use strict';

angular.module('admin.services', ['ngResource'])
	.factory('Items', function($resource){
		return $resource('back/data.php', {});
	})
	.factory('ReqItem', function($resource){
		return $resource('back/data2.php', {});
	})
	
