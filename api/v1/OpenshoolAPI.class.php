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

    /**
     * Example of an Endpoint
     */
     protected function example() {
        if ($this->method == 'GET') {
            return "Your name is " . $this->User->name;
        } else {
            return "Only accepts GET requests";
        }
     }
     
     
     
    protected function user($args){
        require_once '../../model/user.class.php';
        $usr = new ModelUser("../../settings.ini");
        
        switch($this->verb){
            
            case "LOGIN":
                
                return $usr->getFirst($args[0],$args[1]);
                break;
            
        }
        
        
    }
 }
 
 ?>