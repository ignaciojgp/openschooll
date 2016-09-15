(function(){
	
	var module = angular.module("menu",[]);
	
	module.directive("mainMenu",function($location){
		
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
				$location.url(item.name);
			}
			
			
	              
	                
            }
		}
		
	})
	
	
})();