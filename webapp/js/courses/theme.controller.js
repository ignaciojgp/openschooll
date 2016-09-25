(function(){
	
	var mod = angular.module('themeModule',['osapi','lessonModule']);
	
	mod.directive("themeDetail",  ['$location','osapi',function($location, osapi){
		return {
			link: function($scope,$element,$attr){
				
				
				$scope.$watch("theme",function(){
					$scope.selectedLesson = null;
					$scope.detail = null;
					
					if($scope.theme != null){
						osapi.getTheme($scope.theme.id).then(
							function(ret){
								$scope.detail = ret;
								
								$scope.$on('$locationChangeSuccess', locationChange);
								locationChange(null);
							},
							function(ret){
								debugger;
								
							}
						
						)
						
					}
					
				},true);
				
				
				$scope.subscribe = function(){
					
					osapi.subscribe($scope.theme.id).then(
						function(res){
							$scope.detail.subscription = 1;
						},
						function(res){
							debugger;
						}
					)
					
				}
				
				$scope.selectLesson = function(lesson){
					
					$location.path("/courses/"+$scope.theme.name+"/"+lesson.id);
				}
				
				
				/*
				reconoce cuando cambia la ubicacion 
				*/
				function locationChange(event){
					
					var path = $location.url();
					var sections = path.split("/");
					var lessonID = sections[3];
					if(lessonID && $scope.detail && $scope.detail.lessons ){
						var idLesson = decodeURIComponent(lessonID);
						var lessonCoincidente = $scope.detail.lessons.filter(function(item){return item.id == idLesson})[0]
						
						if(lessonCoincidente){
							$scope.selectedLesson  = lessonCoincidente;
						}
					}
				}
				
				
				
				
			},
			scope:{
				theme:"="
			},
			
			templateUrl:"js/courses/themedetail.view.html",
			
			
		};
	}]);
	
	
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