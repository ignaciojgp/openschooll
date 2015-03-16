<?php
    
    include_once("../core/sqlconnection.class.php");
    
    class ModelUser extends sqlconnection{
        
        const TABLENAME="user";
        const COL_ID="id";
        const COL_EMAIL = "email";
        const COL_PASS = "pass";
        const COL_STATUS = "status";
        const COL_VISIBILITY = "visibility";
        const COL_IP_ADDRESS = "ipAddress";
        const COL_ENABLED = "enabled";
        const COL_CREATED_AT = "createdAt";
        const COL_PREFERED_LANGUAJE = "prefered_languaje";
        const COL_TOKEN = "token";
        
        
        public function __construct($file = '../settings.ini'){
            
            parent ::__construct(self::TABLENAME,array(),$file);
            
            
            
        }
        
        
        public function getFirst($email, $pass){
            
            
            
            $query = 'SELECT * FROM '.self::TABLENAME.' WHERE '.self::COL_EMAIL.' = "'.pg_escape_string($email).'" AND '.self::COL_PASS.' = "'.md5($pass).'" LIMIT 1';
            
           
            $sth = $this->prepare($query);
        
            $sth->execute();
            
            
            $user = $sth->fetch();
            
            
            
            if($user != null){
                
                unset($user['pass']);
                unset($user['2']);
                
                return Array("code"=>200,"message"=>$user);
            }else{
                return Array("code"=>404,"message"=>null);
            }
            
        }
        
        public function saveNew($email, $pass, $status, $visibility, $ipAdress, $enabled, $lang){
            
            
            
            if(trim($email) == "" || trim($pass)==""){
                return array("code"=>400,"message"=>"el email y el passworn no pueden estar vacios");
            }
            
            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
              
                return array("code"=>400,"message"=>"el email no es valido");
            
            }
            
            
            $query = 'INSERT INTO '.self::TABLENAME.' (';
                $query .= self::COL_EMAIL.', ';
                $query .= self::COL_PASS.', ';
                $query .= self::COL_STATUS.', ';
                $query .= self::COL_VISIBILITY.', ';
                $query .= self::COL_IP_ADDRESS.', ';
                $query .= self::COL_ENABLED .', ';
                $query .= self::COL_PREFERED_LANGUAJE;
                $query .= ') VALUES (';
                $query .= ' "'.pg_escape_string($email).'" ,';
                $query .= ' "'.md5($pass).'" ,';
                $query .= ' "'.pg_escape_string($status).'" ,';
                $query .= ' "'.pg_escape_string($visibility).'" ,';
                $query .= ' "'.pg_escape_string($ipAdress).'" ,';
                $query .= ' "'.pg_escape_string($enabled).'" ,';
                $query .= ' "'.pg_escape_string($lang).'")';
            
           
            $sth = $this->prepare($query);
            
            
            try{
                
                $sth->execute();
                
                return Array("code"=>201,"message"=>intval($this->lastInsertId()));
                
            }catch(PDOException $pdoe){
                
                return Array("code"=>400,"message"=>"El correo electrónico ya fue registrado anteriormente");
            }
           
        }
        
        
        public function setTokenForReset($email){
            
            $newToken = md5( $email.time());
            
            $query = ' update '.self::TABLENAME.' set '.self::COL_TOKEN.' = "'.$newToken.'" WHERE email = "'.pg_escape_string($email).'" LIMIT 1';
            
            $sth = $this->prepare($query);
            
            try{
                
                $sth->execute();
                
                if($sth->rowCount()>0){                
                    return Array("code"=>200,"message"=>$newToken);
                }else{
                    return Array("code"=>400,"message"=>"el token no fue actualizado");
                }
                
            }catch(PDOException $pdoe){
                
                return Array("code"=>400,"Error en el server intente nuevamente");
            }
            
        }
        
        public function setNewPassword($email, $pass, $token){
            
            $query = ' update '.self::TABLENAME.' set  '.self::COL_PASS.' = "'.md5($pass).'" , '.self::COL_TOKEN.' =  NULL WHERE '.self::COL_EMAIL.' = "'.pg_escape_string($email).'" and '.self::COL_TOKEN.' = "'.$token.'" ';
            
            
            $sth = $this->prepare($query);
            
            try{
                
                $sth->execute();
                
                if($sth->rowCount()>0){
                    
                    return Array("code"=>200,"message"=>"se actualizó el password");
                
                }else{
                    return Array("code"=>400,"message"=>"el registro no fue actualizado");
                }
                
            }catch(PDOException $pdoe){
                
                return Array("code"=>400,"message"=>"Error en el server intente nuevamente");
            }
        }
        
        
    }
    
?>