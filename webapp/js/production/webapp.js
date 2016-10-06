(function(){

	var mod = angular.module('courseModule',['osapi','themeModule'])

	var cont = mod.controller("coursecontroller" , function($scope,osapi, $location){
		
		$scope.themes = [];

		$scope.$watch("view",function(){

			if($scope.view == "all"){
				$scope.themes = $scope.allthemes;

			}else{
				$scope.themes = $scope.mythemes;
			}

		},true);

		$scope.regresar =function(){
			$scope.selectedTheme = null;
			$location.path("/courses");

		}

		osapi.getAllThemes().then(
			function(message){
				$scope.allthemes = message;
				if($scope.view == "all"){
					$scope.themes = $scope.allthemes;
				}

				$scope.$on('$locationChangeSuccess', cambioUbicacion);
				cambioUbicacion(null);
			},
			function(message){
				alert(message);
			});


		/*
		reconoce cuando cambia la ubicacion
		*/
		function cambioUbicacion(event){

			var path = $location.url();

			var secciones = path.split("/");
			var nombreTema = secciones[2];
			if(nombreTema && $scope.allthemes){
				var nom = decodeURIComponent(nombreTema);
				var themaCoincidente = $scope.allthemes.filter(function(item){return item.name == nom})[0]

				if(themaCoincidente){
					$scope.selectedTheme  = themaCoincidente;
				}
			}
		}

	})




})();
;(function(){
	
	var mod = angular.module('lessonModule',['osapi']);
	
	mod.directive("lessonDetail", function(osapi){
		return {

			link: function($scope,$element,$attr){
				
				
				$scope.$watch("lesson",function(){
					console.log("lesson change")
					if($scope.lesson != null){
						osapi.getLesson($scope.lesson.id).then(
							function(ret){
								$scope.lessonDetail = ret;
							},
							function(ret){
								console.log("error en lesson detail");
								console.log(ret);
								
							}
						
						)
						
					}
					
				},true);
				
				
				
				
			},
			scope:{
				lesson:"="
			},
			
			templateUrl:"js/courses/lessondetail.view.html",
			
			
		};
	});
	
	
	
	
})();(function(){
	
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