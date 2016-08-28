<?php
require_once 'API.class.php';


class OpenshoolAPI extends API
{
    protected $User;

    public function __construct($request, $origin) {
        parent::__construct($request);
        
        if($_REQUEST['apiusr'] != "nacho" || $_REQUEST['apikey'] != "1c8c5ef73ec6a7a9069604b9648f33cf"){
            throw new Exception("no tiene acceso",400);
        }
        
    }
 
 
    protected function user($args){
        require_once '../model/user.class.php';
        
        $usr = new ModelUser("../settings.ini");
        
        switch($this->verb){
            
            case "LOGIN":
                
                
                $myuser =  $usr->getFirst($args[0],$args[1]);
                
                if($myuser['code'] == 200){
                    $_SESSION['myuser']= $myuser['message'];
                }
                
                
                return $myuser;
                
                break;
            
            
            case "REGISTER":
                
                if($_REQUEST['capcha'] == $_SESSION['captcha']){
                    $result= $usr->saveNew($args[0],$args[1],0,1,ip2long(get_client_ip()),1,"es");
                }else{
                    $result = Array('code'=>400,'message'=>'el capcha '.$_REQUEST['capcha'].' no es igual a '.$_SESSION['captcha']);
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