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
