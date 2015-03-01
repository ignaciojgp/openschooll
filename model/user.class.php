<?php

    include_once("../core/sqlconnection.class.php");
    
    class user extends sqlconnection{
        
        public function __construct(){
            
            parent ::__construct("user",array());
            
        }
        
    }
    
?>