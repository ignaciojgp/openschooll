<?php
    header("content-type:text/javascript");
    include_once("../core/core.php");
    include_once("../model/menu.class.php");

    echo "probando theme \n";
    
    
    
    
    
   
    
    try{
        
        $db = new ModelMenu();
        
        $method = isset($_REQUEST['m']) ?  $_REQUEST['m'] :1;
        
        switch($method){
            
            case 1:
                
                echo "probando getAll() \n";
                print_r($db->getAll());
                
                break;
        
            case 2:
        
                echo "probando getMenuForUser() \n";
                // print_r($db->getMenuForUser("'ignaciojpg@gmail.com'","ES"));
                print_r($db->getMenuForUser("'contacto@visualeaks.com'","ES"));
                    
                break;
            
        
        }
        
        
        echo "fin de la prueba \n";
        
        
        
        
        
    
    }catch(Exception $e){
        
        print_r($e);
        
        
    }
    
    
?>