(function(){
    var module = angular.module("my_studentsModule",['osapi']);
    module.controller("my_studentsController",function($scope,osapi){
        osapi.getMyStudents().then(
            function(res){
                $scope.list = res;
            },
            function(res){
                console.log(res);
            }
        )


    });
})();
