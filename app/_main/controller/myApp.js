'use strict';

angular.module("myApp", ['ngSanitize','ngNotify']).filter('roundup', function () {
	return function (value) {
		return Math.ceil(value);
	};
}).directive('ngConfirmClick', [
	function(){
		return {
			link: function (scope, element, attr) {
				var msg = attr.ngConfirmClick || "Are you sure?";
				var clickAction = attr.confirmedClick;
				element.bind('click',function (event) {
					if ( window.confirm(msg) ) {
						scope.$eval(clickAction)
					}
				});
			}
		};
}]).filter('nl2br', function($sce){
	return function(msg,is_xhtml) {
		var is_xhtml = is_xhtml || true;
		var breakTag = (is_xhtml) ? '<br />' : '<br>';
		var msg = (msg + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
		return $sce.trustAsHtml(msg);
	}
}).filter('zpad', function() {
	return function(input, n) {
		if(input === undefined)
			input = ""
		if(input.length >= n)
			return input
		var zeros = "0".repeat(n);
		return (zeros + input).slice(-1 * n)
	};
}).directive('loading',   ['$http' ,function ($http){
	return {
		restrict: 'A',
		link: function (scope, elm, attrs){
			scope.isLoading = function () {
				return $http.pendingRequests.length > 0;
			};
			scope.$watch(scope.isLoading, function (v){
				if(v){
					elm.show();
				}else{
					elm.hide();
				}
			});
		}
	};
}]);