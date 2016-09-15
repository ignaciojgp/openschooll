(function(){
	
	var mod = angular.module('themeModule',['osapi']);
	
	mod.directive("themeDetail", function(osapi){
		return {

			link: function($scope,$element,$attr){
				
				$scope.$watch("theme",function(){
					
					if($scope.theme != null){
						osapi.getTheme($scope.theme.id).then(
							function(ret){
								$scope.detail = ret;
								
							},
							function(ret){
								debugger;
								
							}
						
						)
						
					}
					
				},true)
				
			},
			scope:{
				theme:"="
			},
			
			templateUrl:"js/courses/themedetail.view.html",
			
			
		};
	});
	
	
	mod.directive("themeList",function($location){
		return {
			scope:{
				list:"=list",
				
			},
			controller:function($scope){
				
				$scope.selectTheme = function(theme){
					//$scope.$parent.selectedTheme = theme;
					$location.path("/courses/"+theme.name);
				}
				
			},
			templateUrl:"js/courses/themelist.view.html",
			
			
		};
	});
	
})()