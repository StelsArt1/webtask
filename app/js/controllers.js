'use strict';

function ListCtrl($scope, Items, ReqItem) {
	$scope.Math = Math;
	$scope.items = Items.query(function(data){
		$scope.paginator.setPages($scope.items.length); 
		var i = 0;
		angular.forEach(data, function(v,k) { data[k]._id = i++; });
	});
	$scope.items2 = ReqItem.query(function(data)
	{
		$scope.paginator2.setPages($scope.items2.length); 
		var i = 0;
		angular.forEach(data, function(v,k) { data[k]._id = i++; });
	});
	//console.log($scope.items);
	//console.log($scope.items2);

	$scope.paginator = {
		count: 10,
		page:  1,
		pages: 1,
		setPages: function(itemsCount){ this.pages = Math.ceil(itemsCount/this.count); }
	};
	$scope.paginator2 = {
		count: 10,
		page:  1,
		pages: 1,
		setPages: function(itemsCount){ this.pages = Math.ceil(itemsCount/this.count); }
	};
	
	$scope.tablehead = [
		{title:"id"},
		{title:"CardNumber"},
		{title:"mmgg"},
		{title:"CVC"},
		{title:"Sum"},
		{title:"Comment"},
		{title:"email"},
		{title:"Security"}
	];
	
	$scope.tablehead2 = [
		{title:"id"},
		{title:"inn"},
		{title:"bik"},
		{title:"card"},
		{title:"nds"},
		{title:"money"},
		{title:"phone"},
		{title:"email"}
	];

	$scope.sortBy = function(flag) {
		if (flag) 
		{
			$scope.sortFlag = $scope.tablehead;
		} else {
			$scope.sortFlag = $scope.tablehead2;
		}
		var order = [];
		angular.forEach($scope.sortFlag, function(h){
			if (h.sort>0) 
				order[h.sort-1] = h.title;
			if (h.sort<0) 
				order[Math.abs(h.sort)-1] = '-'+h.title;
		});
		return order;
	};
	$scope.sortReorder = function(col,e, flag) {
		if (flag) 
			$scope.sortFlag2 = $scope.tablehead;
		else 
			$scope.sortFlag2 = $scope.tablehead2;
		angular.forEach($scope.sortFlag2 , function(el) {
			if (el.title==col)
				el.sort = el.sort>0?-1:1 
			else 
				el.sort = null;	
		});	
	};
	
	$scope.sec = true;
	$scope.disableItem = function() {
		var item = this.item; 
		if ($scope.sec)
		{			
			item.shown = 1; 
			$scope.sec = false;
		}
		else
		{
			item.shown = 0;
			$scope.sec = true;
		}
	};	
}
