<?php
    header("content-type:text/javascript");
    include_once("../core/core.php");
    include_once("../model/media.class.php");

    echo "probando theme \n";
    
    
     
    try{
        
        $db = new ModelMedia();
        
        $method = isset($_REQUEST['m']) ?  $_REQUEST['m'] :1;
        
        switch($method){
            
            case 1:
                
                echo "probando getAll() \n";
                print_r($db->getAll());
                
                break;
        
            case 2:
                
                echo "probando getMediaEnabledByLang() \n";
                print_r($db->getMediaEnabledByLang(1,'ES'));
                
                break;
        
        }
        
        
        echo "fin de la prueba \n";
        
        
        
        
        
    
    }catch(Exception $e){
        
        print_r($e);
        
        
    }
    
    
?>