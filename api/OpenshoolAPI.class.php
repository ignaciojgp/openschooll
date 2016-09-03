<?php
require_once 'API.class.php';


class OpenshoolAPI extends API
{
    protected $User;

    public function __construct($request, $origin) {
        parent::__construct($request);
        
	
	
	if (!isset($_SERVER['PHP_AUTH_USER'])) {
	    echo 'Texto a enviar si el usuario pulsa el botón Cancelar';
	    exit;
	} else {
	    echo "<p>Hola {$_SERVER['PHP_AUTH_USER']}.</p>";
	    echo "<p>Introdujo {$_SERVER['PHP_AUTH_PW']} como su contraseña.</p>";
	}
	
        
        $request_body = file_get_contents('php://input');
        $this->postdata = json_decode($request_body);
        
        $apiuser;
        $apikey;
        
        if(isset($_REQUEST['apiusr']) && isset($_REQUEST['apikey'])){
        	
        	$apiuser = isset($_REQUEST['apiusr']);
        	$apikey = isset($_REQUEST['apikey']);
        	 
        }else if(isset($this->postdata->params->apikey) && isset($this->postdata->params->apiusr)){
        	
        	$apiuser =  $this->postdata->params->apiusr;
        	$apikey = $this->postdata->params->apikey;
        }
       
        
         
      
        
        if($apiuser != "nacho" || $apikey != "1c8c5ef73ec6a7a9069604b9648f33cf"){
            throw new Exception("no tiene acceso",400);
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
    
    protected function theme($args){
        require_once '../model/theme.class.php';
        
        $model = new ModelTheme("../settings.ini");
        
        
        if($this->method == 'GET'){
            if(isset($args[0]))
                return $model->get($args[0]);
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