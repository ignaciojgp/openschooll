<?php
    header("content-type:text/javascript");
    include_once("../core/core.php");
    include_once("../model/theme.class.php");

    echo "probando theme \n";
    
    
    
    
    
   
    
    try{
        
        $db = new ModelTheme();
        
        $method = isset($_REQUEST['m']) ?  $_REQUEST['m'] :1;
        
        switch($method){
            
            case 1:
                
                echo "probando getAll() \n";
                print_r($db->getAll());
                
                break;
        
            case 2:
        
                echo "probando getAllEnabledByLang() \n";
                print_r($db->getAllEnabledByLang("ES"));
                    
                break;
            case 3:
        
                echo "probando get() \n";
                print_r($db->get(1));
                    
                break;
        
        }
        
        
        echo "fin de la prueba \n";
        
        
        
        
        
    
    }catch(Exception $e){
        
        print_r($e);
        
        
    }
    
    
?>