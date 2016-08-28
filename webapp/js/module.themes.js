(function(){
    
    var openSchoolApp= angular.module("themes",['ngSanitize']);

    openSchoolApp.directive("themeList" , function(){
        return {
            restrict:'E',
            templateUrl:'themeList.html',
            controller: function($scope,$http){
                
                var themeList = this;
                
                themeList.themes = [];
                
                themeList.tabSelected =0;
                
                themeList.isTabSelected = function(idtab){
                    return idtab == themeList.tabSelected;
                }
                themeList.selectTab = function(idtab){
                    themeList.tabSelected =idtab ;
                }
                
                $http.get('/openschool/api/themes/es/', $scope.keys).
                    success(function(data, status, headers, config) {
                        
                        if (data.code==200) {
                           
                           themeList.themes = data.message;
                           
                        }else{
                            alert("error "+data.code);
                            
                        }
                        
                    });            
            },
            controllerAs:'themelist'
            
            
            
            
            
        }
    });
    
    openSchoolApp.directive("themeDetail" , function(){
        return {
            restrict:'E',
            templateUrl:'themeDetail.html',            
            controllerAs: 'themeDetail',
            controller: function($scope,$http){
                
                var themeDetail = this;
                
                themeDetail.id =  $scope.idTheme;
                themeDetail.info = {};
                
                
                //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                themeDetail.loadInfo = function(){
                    
                    
                    $http.get('/openschool/api/theme/'+$scope.selectedTheme.id, $scope.keys).
                        success(function(data, status, headers, config) {
                            
                            if (data.code==200) {
                               $scope.selectedTheme  = data.message;
                            }else{
                                alert("error "+data.code);
                            }
                        });  
                  
                  
                };
                
                
                
            }
            
        }
    });
    
    openSchoolApp.directive("lessonDetail" , function(){
        return {
            restrict:'E',
            templateUrl:'lessonDetail.html',            
            controllerAs: 'lessonDetail',
            controller: function($scope,$http){
                
                var lessonDetail = this;
                
            }
            
        }
    });
    
    

})();