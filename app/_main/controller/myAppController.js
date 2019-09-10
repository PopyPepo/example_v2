'use strict';

angular.module('myApp').controller('myAppController', ["$scope", "$http", "$window", 'ngNotify', function($scope, $http, $window, ngNotify){

	$scope.folderInstanceList = [];
	$scope.getFolder= function(){
		$http({
			method: "GET",
			url: PATH+"model/main/?action=getFolder",
			params: $scope.pagination
		}).then(function successCallback(response) {
			$scope.folderInstanceList = response.data.instance;
		}, function errorCallback(error) {
			$scope.displayNotify('error', "เกิดข้อผิดพลาด!! ในการแสดรายการข้อมูลประเภททุน");
			console.log("getFolder list ERROR!!!");
			console.log(error);
		});
	};
	
	var userCallback = function() {
		console.log('Callback triggered after message fades.');
	};

	$scope.displayNotify = function(notify, mass) {
		switch(notify) {
			case 'success':
				ngNotify.set(mass, {
					type: 'success'
				});
				break;
			case 'info':
				ngNotify.set(mass, 'info');
				break;
			case 'warn':
				ngNotify.set(mass, 'warn');
				break;
			case 'warning':
				ngNotify.set(mass, 'warn');
				break;
			case 'error':
				ngNotify.set(mass, 'error');
				break;
			case 'grimace':
				ngNotify.set(mass, 'grimace');
				break;
			case 'html':
				ngNotify.set(mass);
				break;
			case 'modular':
				ngNotify.set(mass, {
					target: '#modular'
				}, userCallback);
				break;
			default:
				ngNotify.set(mass);
				break;
		}
	};

	// Configuration options...

	$scope.theme = 'pastel';
	$scope.duration = 4000;
	$scope.position = 'top';
	$scope.defaultType = 'info';
	$scope.sticky = true;
	$scope.button = true;
	$scope.html = true;
	// Configuration actions...

	$scope.setDefaultType = function() {
		ngNotify.config({
			type: $scope.defaultType
		});
	};

	$scope.setDefaultPosition = function() {
		ngNotify.config({
			position: $scope.position
		});
	};

	$scope.setDefaultDuration = function() {
		ngNotify.config({
			duration: $scope.duration
		});
	};

	$scope.setDefaultTheme = function() {
		ngNotify.config({
			theme: $scope.theme
		});
	};

	$scope.setDefaultSticky = function() {
		ngNotify.config({
			sticky: $scope.sticky
		});
	};

	$scope.setDefaultButton = function() {
		ngNotify.config({
			button: $scope.button
		});
	};

	$scope.setDefaultHtml = function() {
		ngNotify.config({
			html: $scope.html
		});
	};

	$scope.dismissNotify = function() {
		ngNotify.dismiss();
	};

}]);
