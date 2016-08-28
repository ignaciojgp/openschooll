(function(){
    
    var options = {
        params:{
            apiusr:"nacho",
            apikey:"1c8c5ef73ec6a7a9069604b9648f33cf"
            
            
        }
        
    };
    
    var openSchoolApp = angular.module('openschoolApp', []);

    
    
    openSchoolApp.controller('loginController', function ($scope, $http) {
        
        $scope.loginfields = {};
        
        
        $scope.sendLogin = function() {
            if ($scope.valEmail() && $scope.valPass()) {
                
                $http.get('/openschool/api/user/LOGIN/'+$scope.loginfields.email+"/"+$scope.loginfields.pass, options).
                success(function(data, status, headers, config) {
                    
                   
                    if (data.code==200) {
                       //alert("exito "+data.code);
                       window.location.href="desktop.php";
                       
                    }else{
                        alert("error "+data.code);
                        
                    }
                    
                }).
                error(function(data, status, headers, config) {
                    alert("error "+data);
                    
                    
                });
                
                
            }else{
                alert("todos los campos son obligatorios");
            }
            
        }
        
        
        $scope.valEmail = function(){
            if($scope.loginfields.email !=""){
                var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                
                if (re.test($scope.loginfields.email)) {
                    return true;
                }else{
                    return false;
                
                }
                
            }else{
                return false;
            }
        }
        
        
        $scope.valPass = function(){
            return $scope.loginfields.pass !="";
        }
        
    });
    
    //Registro
    openSchoolApp.controller('registerController', function ($scope, $http) {
        
        $scope.fields = {};
        $scope.isRegistering = false;
        $scope.registroExitoso = false;
        $scope.capchaSRC = "captcha.php";
        $scope.registerError="";
        
        
        
        this.sendRegister = function() {
            
            
            options.params.capcha=$scope.fields.capcha;
                    
                
            
            
            
            
            if (this.valEmail() && this.valPass() && this.valConf() &&  $scope.fields.accept) {
                
                $scope.isRegistering = true;
                
                $http.get('/openschool/api/user/REGISTER/'+$scope.fields.email+"/"+$scope.fields.pass, options).
                success(function(data, status, headers, config) {
                    
                    $scope.isRegistering = false;
                    
                   
                    if (data.code==201) {
                         
                        
                        $scope.registroExitoso = true;
                    }else{
                        
                        $scope.registerError = data.message;
                        
                        $scope.registroExitoso = false;
                        
                    }
                    
                }).
                error(function(data, status, headers, config) {
                    $scope.isRegistering = false;
                });
                
                
            }else{
                alert("todos los campos son obligatorios");
            }
            
            
        }
        
        
        this.valEmail = function(){
            if($scope.fields.email !=""){
                var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                
                if (re.test($scope.fields.email)) {
                    return true;
                }else{
                    return false;
                
                }
                
            }else{
                return false;
            }
        }
        
        
        this.valPass = function(){
            return $scope.fields.pass !="";
        }
        
        this.valConf = function(){
            return $scope.fields.pass == $scope.fields.conf;
        }
        
        this.refreshCapcha=function(){            
            $scope.capchaSRC= "captcha.php?r"+Math.random();
        }
        
    });
    
})();