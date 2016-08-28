(function(){
    
    var openSchoolApp = angular.module('openschoolApp',['themes']);
    
    openSchoolApp.controller("PageController" , function($scope,$http){
        
        $scope.vista = 0;
        
        $scope.keys = {
            params:{
                apiusr:"nacho",
                apikey:"1c8c5ef73ec6a7a9069604b9648f33cf"
            }
        };
        
        $scope.user = {};
        
        $http.get('/openschooll/api/user/MYUSER', $scope.keys).
            success(function(data, status, headers, config) {
                if (data.code==200) {
                   $scope.user= data.message;
                }
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
            
            $http.get('/openschooll/api/lesson/'+lesson.id, $scope.keys).
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