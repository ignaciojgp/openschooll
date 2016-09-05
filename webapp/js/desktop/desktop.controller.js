(function(){
    
    var openSchoolApp = angular.module('openschoolApp',['menu','osapi','courseModule']);
    
	
    
    openSchoolApp.controller("PageController" , function($scope,$http,osapi){
			
		$scope.seccion = "";
		$scope.$watch("menuSelectedOption",function(){
			
			if($scope.menuSelectedOption != undefined){
				$scope.seccion = 'js/'+$scope.menuSelectedOption.name+'/default.view.html';	
				
			}else{
			}
			
		},true);
	
        $scope.vista = 0;
        
        $scope.user = {};
        
		osapi.userData().then(
			function(data){
				$scope.user = data;
			},function(message){
				alert(message);
			});
			
        //---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- 
        $scope.selectTheme = function(theme){
            
            if ($scope.selectedTheme == null || $scope.selectedTheme.id != theme.id ) {
                $scope.selectedTheme= theme;
            }
            
            $scope.vista = 0;
        }
        
        
        //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        $scope.loadLesson= function(lesson){
            
            $http.get('/openschool/api/lesson/'+lesson.id, $scope.keys).
                success(function(data, status, headers, config) {
                    
                    if (data.code==200) {
                       $scope.selectedLesson  = data.message;
                       
                       $scope.selectedLesson.theme = $scope.selectedTheme;
                       
                       $scope.vista = 1;
                       
                    }else{
                        alert("error "+data.code);
                    }
                });  
          
        }
    });
})();