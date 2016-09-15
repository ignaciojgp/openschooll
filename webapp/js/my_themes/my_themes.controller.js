(function(){
	
	var mod = angular.module("mythemesModule",['osapi']);
	
	var controller = mod.controller("myThemesController", function($scope, osapi){
		
	});
	
	mod.directive("list",function(){
		return {
			controller:function($scope){
				
				$scope.themeList = [];
				
				$scope.selectTheme = function(theme){
					debugger;
				}
			},
			templateUrl:"js/my_themes/list.view.html",
		};
	});

	mod.directive("formTheme",function(){
		return {
			controller:function($scope){
				
				$scope.themeList = [];
				$scope.languajes = [
					{val:'es',label:'español'},
					{val:'en',label:'inglés'},
				];
				
				$scope.selectTheme = function(theme){
					debugger;
				}
			},
			templateUrl:"js/my_themes/form.view.html",
		};
	});
	
})();