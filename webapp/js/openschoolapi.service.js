(function(){
	
	var S_LOGIN = '/openschool/api/user/LOGIN/';
	
	var mod = angular.module("osapi",[]);
	mod.config(function($httpProvider) {
        $httpProvider.defaults.useXDomain = true;
		$httpProvider.defaults.headers.common['Authorization'] = "Basic bmFjaG86MWM4YzVlZjczZWM2YTdhOTA2OTYwNGI5NjQ4ZjMzY2Y";
    });
	mod.service('osapi',function($http,$q){
		
		
		
		
		/*
			login  -------
		*/
		this.login = function(email,pass){
			var deferred = $q.defer();

			var options = {params:{}};
				
			options.params.email = email;
			options.params.pass =  pass;
			
                
			$http.post(S_LOGIN, options).
                success(function(data, status, headers, config) {
                    if (data.code==200) {
                       deferred.resolve();
                    }else if(data.code == 404){
						deferred.reject("credenciales erróneas");
                    }
                }).
                error(function(data, status, headers, config) {
                    
                    deferred.reject("No pudimos procesar tu solicitud, inténtalo más tarde");
                    
                }
			);
			
			
			return deferred.promise;
		}
		
		/*
			MYUSER
		*/
		this.userData = function(){
			var deferred = $q.defer();

	        $http.get('/openschool/api/user/MYUSER', null).
				success(function(data, status, headers, config) {
					if (data.code==200) {
					   // $scope.user= ;
					   deferred.resolve(data.message);
	 
					}
				}).
				error(function(data, status, headers, config) {
						
					deferred.reject("No pudimos procesar tu solicitud, inténtalo más tarde");
					
				});
			
			
			return deferred.promise;
		}
		

		
		
		
	}) 
})();