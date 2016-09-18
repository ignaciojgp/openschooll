(function(){
	
	
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
			
                
			$http.post('/openschool/api/user/LOGIN/', options).
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
		
		/*
			themas
		*/
		this.getAllThemes = function(){
			var deferred = $q.defer();
			$http.get('/openschool/api/themes/es', null).
				success(function(data, status, headers, config) {
					
					debugger
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
		
		/*
			detalleDeTheme
		*/
		this.getTheme = function(idTheme){
			var deferred = $q.defer();
			$http.get('/openschool/api/theme/es/'+idTheme, null).
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
		
		/*
			save theme
		*/
		this.saveTheme = function(id,name,description, content, lang){
			var deferred = $q.defer();
			
			var data = {
				id:id,
				name:name,
				description:description, 
				content:content, 
				lang:lang
			}
			
			$http({
			    method: 'POST',
			    url: '/openschool/api/theme/',
			    data: $.param(data),
			    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			}).
				success(function(data, status, headers, config) {
					
					if (data.code==200) {
						deferred.resolve(data.message);
	 
					}else{
						deferred.reject(data.message);
						
					}
				}).
				error(function(data, status, headers, config) {
						
					deferred.reject("No pudimos procesar tu solicitud, inténtalo más tarde");
					
				});
			
			
			return deferred.promise;
			
		}
		
		this.getThemesByCreator = function(idUser){
			
			var deferred = $q.defer();
			$http.get('/openschool/api/themesBy/creator/'+idUser, null).
				success(function(data, status, headers, config) {
					if (data.code==200) {
						deferred.resolve(data.message);
					}else{
						deferred.reject([]);
					}
				}).
				error(function(data, status, headers, config) {
						
					deferred.reject("No pudimos procesar tu solicitud, inténtalo más tarde");
					
				});
			
			
			return deferred.promise;
		}
		
		/*
			detalleDeTheme
		*/
		this.getLesson = function(idLesson){
			var deferred = $q.defer();
			$http.get('/openschool/api/lesson/'+idLesson, null).
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