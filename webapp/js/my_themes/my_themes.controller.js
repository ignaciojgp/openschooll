(function () {

	var mod = angular.module("mythemesModule", ['osapi', 'vesparny.fancyModal']);

	var controller = mod.controller("myThemesController", function ($scope, osapi) {
		
			$scope.nuevo = function () {

				$scope.editTheme = {};

			}
			
			$scope.newLesson = function (theme) {

				$scope.editLesson = {id_theme:theme.id};

			}
			
			$scope.$watch("editTheme", function () {
				if ($scope.editTheme != null) {
					$scope.view = 'form';
				} else {
					$scope.view = 'list';
				}

			}, true);
			
			$scope.$watch("editLesson", function () {
				if ($scope.editLesson != null) {
					$scope.view = 'formLesson';
				} else {
					$scope.view = 'list';
				}

			}, true);
			
		});

	mod.directive("mythemesList", function () {
		return {
			controller : function ($scope, osapi) {

				$scope.themes = [];

				osapi.getThemesByCreator(3).then(
					function (res) {
					$scope.themes = res;
				},
					function (res) {
					debugger;
				})

				$scope.selectTheme = function (theme) {
					osapi.getTheme(theme.id).then(
						function (ret) {
							$scope.$parent.editTheme = ret;
						},
						function (ret) {})
				}
				
				$scope.newLesson = function(theme){
					$scope.$parent.newLesson(theme);
					
				}
				
				$scope.selectLesson = function(lesson){
					osapi.getLesson(lesson.id).then(
						function (ret) {
							$scope.$parent.editLesson = ret;
						},
						function (ret) {})
				}

				$scope.moreInfo = function(theme){
					
					angular.forEach($scope.themes, function(value, key) {
						
						if(value == theme ){
							value.info =  !value.info;
						}else{
							value.info = false;
						}
						
					 
					},null);
					
				}
				
			},
			templateUrl : "js/my_themes/list.view.html",
		};
	});

	mod.directive("formTheme", function (osapi) {
		return {
			scope : {
				theme : "="

			},
			// resolve:{
			// osapi:function(){return osapi}

			// },
			controller : function ($scope, $element, $attrs, osapi, $fancyModal) {
				$scope.languajes = [{
						val : 'es',
						label : 'español'
					}, {
						val : 'en',
						label : 'inglés'
					},
				];

				$scope.submit = function () {

					$scope.ModalMessage = "guardando espere un momento";

					var modal = $fancyModal.open({
							template : '<p>{{ModalMessage}}</p>',
							closeOnEscape : false,
							closeOnOverlayClick : false,
							showCloseButton : false,
							scope : $scope
						});

					$scope.sending = true;
					osapi.saveTheme(
						$scope.theme.id,
						$scope.theme.name,
						$scope.theme.description,
						$scope.theme.content,
						$scope.theme.lang).then(
						function (res) {
							if (res.insertedId != undefined && $scope.id == undefined) {
								$scope.theme.id = res.insertedId;
							}
							
							$scope.ModalMessage = "Tema guardado";

							setTimeout(function () {
								modal.close();
							}, 2000);

						},
						function (res) {
							$scope.ModalMessage = res;
							setTimeout(function () {
								modal.close();
							}, 2000);
						});
				}
			},
			templateUrl : "js/my_themes/form.view.html",
		};
	});

	mod.directive("formLesson", function (osapi) {
		return {
			scope : {
				lesson : "="
			},
			controller : function ($scope, $element, $attrs, osapi, $fancyModal) {
				$scope.visibleOptions =[ 
					{
						value:1,
						label:"si"
					},
					{
						value:0,
						label:"no"
					}
				];
				
				$scope.submit = function () {

					$scope.ModalMessage = "guardando espere un momento";

					
					
					var modal = $fancyModal.open({
							template : '<p>{{ModalMessage}}</p>',
							closeOnEscape : false,
							closeOnOverlayClick : false,
							showCloseButton : false,
							scope : $scope
						});

					$scope.sending = true;
					osapi.saveLesson(
						$scope.lesson.id,
						$scope.lesson.id_theme,
						$scope.lesson.title,
						$scope.lesson.description,
						$scope.lesson.content,
						$scope.lesson.enabled,
						$scope.lesson.value
						
						).then(
							function (res) {
								if (res.insertedId != undefined && $scope.id == undefined) {
									$scope.lesson.id = res.insertedId;
								}
								
								$scope.ModalMessage = "Lección guardada";

								setTimeout(function () {
									modal.close();
								}, 2000);

							},
							function (res) {
								$scope.ModalMessage = res;
								setTimeout(function () {
									modal.close();
								}, 2000);
							});
				}
			},
			templateUrl : "js/my_themes/formLesson.view.html",
		};
	});

})();
