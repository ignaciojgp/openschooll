<?php
    
    include_once("../core/sqlconnection.class.php");
    
    class ModelTheme extends sqlconnection{
        
        const TABLENAME="theme";
        const COL_ID="id";
        const COL_NAME = "name";
        const COL_CREATED_AT = "createdAt";
        const COL_UPDATED_AT = "updatedAt";
        const COL_ENABLED = "enabled";
       
        
        
        public function __construct(){
            
            parent ::__construct(self::TABLENAME,array());
            
        }
        
        
        
    }
    
    
?>