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
                
                return Array(200,$user);
            }else{
                return Array(404,null);
            }
            
        }
        
        public function saveNew($email, $pass, $status, $visibility, $ipAdress, $enabled, $lang){
            
            if(trim($email) == "" || trim($pass)==""){
                return array(400,"el email y el passworn no pueden estar vacios");
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
                
                return Array(201,$this->lastInsertId());
                
            }catch(PDOException $pdoe){
                
                return Array(400,"El correo electr—nico ya fue ingresado anteriormente");
            }
           
        }
        
        
        public function setTokenForReset($email){
            
            $newToken = md5( $email.time());
            
            $query = ' update '.self::TABLENAME.' set '.self::COL_TOKEN.' = "'.$newToken.'" WHERE email = "'.pg_escape_string($email).'" LIMIT 1';
            
            $sth = $this->prepare($query);
            
            try{
                
                $sth->execute();
                
                if($sth->rowCount()>0){                
                    return Array(200,$newToken);
                }else{
                    return Array(400,"el token no fue actualizado");
                }
                
            }catch(PDOException $pdoe){
                
                return Array(400,"Error en el server intente nuevamente");
            }
            
        }
        
        public function setNewPassword($email, $pass, $token){
            
            $query = ' update '.self::TABLENAME.' set  '.self::COL_PASS.' = "'.md5($pass).'" , '.self::COL_TOKEN.' =  NULL WHERE '.self::COL_EMAIL.' = "'.pg_escape_string($email).'" and '.self::COL_TOKEN.' = "'.$token.'" ';
            
            
            $sth = $this->prepare($query);
            
            try{
                
                $sth->execute();
                
                if($sth->rowCount()>0){
                    
                    return Array(200,"se actualiz— el password");
                
                }else{
                    return Array(400,"el registro no fue actualizado");
                }
                
            }catch(PDOException $pdoe){
                
                return Array(400,"Error en el server intente nuevamente");
            }
        }
        
        
    }
    
?>