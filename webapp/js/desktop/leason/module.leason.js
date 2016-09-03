(function(){
    
    var openSchoolApp= angular.module("leason",['ngSanitize']);
    
    openSchoolApp.directive("lessonDetail" , function(){
        return {
            restrict:'E',
            templateUrl:'js/desktop/leason/lessonDetail.html',            
            controllerAs: 'lessonDetail',
            controller: function($scope,$http){
                
                var lessonDetail = this;
                
            }
            
        }
    });
    
    
})();