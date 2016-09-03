(function(){
	
	var module = angular.module("menu",[]);
	
	module.directive("mainMenu",function(){
		
		return {
			restrict:'E',
			scope:{
				menuOptions:"=options",
				selected:"=selection",
				
			},
			templateUrl:'js/menu/menu.html',            
			controllerAs: 'lessonDetail',
			controller: function($scope,$element,$http){
	                
			
			$scope.setSelection = function(item){
				$scope.selected = item;
			}
			
			
	               //$scope.menuOptions = ["hola","mundo"];
	                
            }
		}
		
	})
	
	
})();