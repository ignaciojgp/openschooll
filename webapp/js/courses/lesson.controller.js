(function(){
	
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
	
	
	
	
})()