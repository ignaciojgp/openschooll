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
			
			$this->requireSession();
			
			return Array('code'=>200,'message'=>$_SESSION['myuser']);
			
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
		require_once '../model/themeSubscription.class.php';
		
		$model = new ModelTheme("../settings.ini");
		$model2 = new ModelThemeSubscription("../settings.ini");
		
		
		if($this->method == 'GET'){
			if(isset($args[0]))
				
			$theme = $model->get($args[0]);
			
			if(isset($_SESSION['myuser'])){
				
				$suscription = $model2->find($_SESSION['myuser']['id'],$args[0]);
				
				if($suscription['code']==200){
					$theme["message"]["subscription"] = 1;
					
				}else{
					$theme["message"]["subscription"] = 0;
				}
				//print_r($suscription);
			}else{
				
				$theme["message"]["subscription"] = -1;
				
			}
			
			return $theme;
		}
		
		if($this->method == 'POST'){
			$this->requireSession();
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
		
		if($this->method == 'POST'){
			
			$this->requireSession();
			if(
					isset($_REQUEST['id']) &&
					isset($_REQUEST['idTheme']) &&
					isset($_REQUEST['title']) &&
					isset($_REQUEST['description']) &&
					isset($_REQUEST['content']) &&
					isset($_REQUEST['enabled']) &&
					isset($_REQUEST['value']) 
					){
				
				$result = $model->save(
					$_REQUEST['id'] != ''  ?  $_REQUEST['id']  : null,
					$_REQUEST['idTheme'] ,
					$_REQUEST['title'] ,
					$_REQUEST['description'] ,
					$_REQUEST['content'],
					$_REQUEST['enabled'],
					$_REQUEST['value'] 
					
				);
							// $id, $idTheme, $title, $description, $content,  $enabled, $value
				
				return Array('code'=>200,'message'=>$result);
			}
			//return $model->get($args[0]);
		}
		
		return Array('code'=>400,'message'=>'solicitud mal formada');
		
		
	}

	protected function subscribe($args){
		
		
		
		require_once '../model/themeSubscription.class.php';
		$model = new ModelThemeSubscription("../settings.ini");
		
		if($this->method == 'POST'){
			$this->requireSession();
			
			if(isset($args[0])){
				
				$result = $model->create($_SESSION['myuser']['id'],$args[0]);
				
				return Array('code'=>200,'message'=>$result);
				
			}
		}
		
		return Array('code'=>500,'message'=>'solicitud mal formada');
	}
	
	
	function requireSession(){
		
		if(!isset($_SESSION['myuser'])){
			
			throw new Exception("no tiene acceso",401);
		}
		
	}
	
}

?>