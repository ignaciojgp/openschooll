(function(){
	
	var mod = angular.module('courseModule',['osapi'])

	var cont = mod.controller("coursecontroller" , function($scope,osapi){
		
		$scope.themes = [];
		$scope.selectedTheme = null;

		$scope.$watch("view",function(){
			
			if($scope.view == "all"){
				$scope.themes = $scope.allthemes;
				
			}else{
				$scope.themes = $scope.mythemes;
			}
			
		},true);
		
		
		osapi.getAllThemes().then(
			function(message){
				$scope.allthemes = message;
				if($scope.view == "all"){
					$scope.themes = $scope.allthemes;
				}
			},
			function(message){
				alert(message);
			});
		
		
		
	})
	
	cont.directive("themeList",function(){
		return {
			scope:{
				list:"=list",
				
			},
			controller:function($scope){
				
				$scope.selectTheme = function(theme){
					$scope.$parent.selectedTheme = theme;
					
				}
				
			},
			templateUrl:"js/courses/themelist.view.html",
			
			
		};
	});
	
	cont.directive("themeDetail",function(){
		return {
			scope:{
				theme:"=theme"
			},
			
			templateUrl:"js/courses/themedetail.view.html",
			
			
		};
	});


})();