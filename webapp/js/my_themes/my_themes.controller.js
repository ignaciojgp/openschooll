(function(){
	
	var mod = angular.module("mythemesModule",['osapi']);
	
	var controller = mod.controller("myThemesController", function($scope, osapi){
		$scope.nuevo = function(){
			
			$scope.edithTheme = {};
			
		}
		
		$scope.$watch("edithTheme",function(){
			if($scope.edithTheme != null){
				$scope.view = 'form';
			}else{
				$scope.view = 'list';
			}
			
		},true);
	});
	
	mod.directive("mythemesList",function(){
		return {
			controller:function($scope, osapi){
				
				$scope.themes = [];
				
				osapi.getThemesByCreator(3).then(
					function(res){
						$scope.themes = res;
					},
					function(res){
						debugger;
					}
				)
				
				
				$scope.selectTheme = function(theme){
					osapi.getTheme(theme.id).then(
						function(ret){
							$scope.$parent.edithTheme = ret;
							
						},
						function(ret){}
					)
				}
				
				
			},
			templateUrl:"js/my_themes/list.view.html",
		};
	});

	mod.directive("formTheme",function(osapi){
		return {
			scope:{
				theme:"=ediththeme"
				
			},
			// resolve:{
				// osapi:function(){return osapi}
				
			// },
			controller:function($scope, $element, $attrs, osapi){
				$scope.languajes = [
					{val:'es',label:'español'},
					{val:'en',label:'inglés'},
				];
				
				$scope.submit = function(){
					$scope.sending= true;
					osapi.saveTheme(
						$scope.theme.id,
						$scope.theme.name,
						$scope.theme.description,
						$scope.theme.content,
						$scope.theme.lang
					).then(
						function(res){
							if(res.insertedId != undefined && $scope.id == undefined){
								$scope.theme.id = 	res.insertedId;
							}
							
						},
						function(res){
							debugger;
						}

					);
				}
			},
			templateUrl:"js/my_themes/form.view.html",
		};
	});
	
})();