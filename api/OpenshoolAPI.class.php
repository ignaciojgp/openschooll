<?php
require_once 'API.class.php';


class OpenshoolAPI extends API
{
    protected $User;

    public function __construct($request, $origin) {
        parent::__construct($request);
        
	
	
	if (!isset($_SERVER['PHP_AUTH_USER'])) {
	    throw new Exception("no tiene acceso",401);
	    exit;
	} else {
		$apiuser= $_SERVER['PHP_AUTH_USER'];
		$apikey=$_SERVER['PHP_AUTH_PW'];
	   
	}
	
        
        $request_body = file_get_contents('php://input');
        $this->postdata = json_decode($request_body);
        
        
         
      
        
        if($apiuser != "nacho" || $apikey != "1c8c5ef73ec6a7a9069604b9648f33cf"){
            throw new Exception("no tiene acceso",401);
        }
        
    }
 
 
    protected function user($args){
        require_once '../model/user.class.php';
        require_once '../model/menu.class.php';
	
        
        $usr = new ModelUser("../settings.ini");
        
        switch($this->verb){
            
            case "LOGIN":
                
            	$menus = new ModelMenu("../settings.ini");
            	

            	
                
                $myuser =  $usr->getFirst($this->postdata->params->email,$this->postdata->params->pass);
                
                if($myuser['code'] == 200){
			
					$mymenues = $menus->getMenuForUser($myuser['message']['email'],'es');
			
                    $_SESSION['myuser']= $myuser['message'];
		    
					$_SESSION['myuser']['menu'] =  $mymenues["message"];
		    
		    
                }
                
                
                return $myuser;
                
                break;
            
            
            case "REGISTER":
                
                if($this->postdata->params->captcha == $_SESSION['captcha']){
			
                    $result= $usr->saveNew($this->postdata->params->email,$this->postdata->params->pass,0,1,ip2long(get_client_ip()),1,"es");
		    
                }else{
                    $result = Array('code'=>400,'message'=>'el capcha '.$this->postdata->params->captcha.' no es igual a '.$_SESSION['captcha']);
                }
                return $result;
                break;
            
            case "MYUSER":
                
                if(isset($_SESSION['myuser'])){
                    return Array('code'=>200,'message'=>$_SESSION['myuser']);
                }
                return Array('code'=>400,'message'=>'no ha iniciado sesi—n');
                break;
            
        }
    }
    
    
    
    protected function themes($args){
        require_once '../model/theme.class.php';
        
        $model = new ModelTheme("../settings.ini");
        
        
        switch($this->method){
            
            case "GET":
                
		return $model->getAllEnabledByLang($this->verb);
                
                break;
            
            
            
        }
        
    }
    
    protected function themesBy($args){
        require_once '../model/themeauthor.class.php';
        $model = new ModelThemeAuthor("../settings.ini");
        
        
        switch($this->verb){
            
            case "creator":
                
		return $model->getByUser($args[0]);
                
                break;
            
            
            
        }
        
    }
    
    protected function theme($args){
        require_once '../model/theme.class.php';
        
        $model = new ModelTheme("../settings.ini");
        
        
        if($this->method == 'GET'){
            if(isset($args[0]))
                return $model->get($args[0]);
        }
             
	if($this->method == 'POST'){
		if(
			isset($_REQUEST['id']) &&
			isset($_REQUEST['name']) &&
			isset($_REQUEST['description']) &&
			isset($_REQUEST['content']) &&
			isset($_REQUEST['lang']) 
		){
			
			$result = $model->save(
				$_REQUEST['id'] != ''  ?  $_REQUEST['id']  : null,
				$_REQUEST['name'] ,
				$_REQUEST['description'] ,
				$_REQUEST['content'],
				$_REQUEST['lang'] 
				
			);
			
			if(isset($result['insertedId'])){
				
				require_once '../model/themeauthor.class.php';
				
				$model2 = new ModelThemeAuthor("../settings.ini");
				
				$model2->setCreatorToTheme($_SESSION['myuser']['id'],$result['insertedId']);
				
			}
			
			return Array('code'=>200,'message'=>$result);
		}
                //return $model->get($args[0]);
        }
           
        return Array('code'=>400,'message'=>'solicitud mal formada');
        
        
    }
    
    protected function lesson($args){
        require_once '../model/lesson.class.php';
        $model = new ModelLesson("../settings.ini");
        
        if($this->method == 'GET'){
            if(isset($args[0]))
                return $model->get($args[0]);
        }
           
           
        return Array('code'=>400,'message'=>'solicitud mal formada');
        
        
    }
    
 }
 
 ?>