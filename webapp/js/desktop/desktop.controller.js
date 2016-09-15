(function(){
    
    var openSchoolApp = angular.module('openschoolApp',['menu','osapi','courseModule']);
    
	
    
    openSchoolApp.controller("PageController" , function($scope,$http,osapi,$location){
	$scope.vista = 0;
        $scope.user = {};
	$scope.seccion = "";

	
	$scope.$on('$locationChangeSuccess', function(event) {
		reconoceSeccion();
	});

	
        
	osapi.userData().then(
		function(data){
			$scope.user = data;
			reconoceSeccion();
		},
		function(message){
			alert(message);
		});

	function reconoceSeccion(){
		
		var path = $location.url();
		
		var seccion = path.split("/");
		
		if($scope.user.menu != undefined && seccion.length > 1){

			
			var seccionUsuario = $scope.user.menu.filter(function(item){ return item.name == seccion[1]})[0]
			
			if(seccionUsuario){
				
				$scope.seccion = 'js/'+seccionUsuario.name+'/default.view.html';
			}
			
				
		}
		
		
	}
	
       
    });
})();