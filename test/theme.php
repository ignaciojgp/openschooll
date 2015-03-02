<?php
    header("content-type:text");
    include_once("../core/core.php");
    include_once("../model/theme.class.php");

    echo "probando theme \n";
    
    
    
    
    
   
    
    try{
        
        $db = new theme();
        
        
        /*
        echo "probando setTokenForReset() \n";
        print_r($user->setTokenForReset("ignaciojpg@gmail.com"));

        */
        
        /*
        echo "probando getFirst() \n";
        print_r($user->getFirst("ignaciojpg@gmail.com","kalil1983"));
        */
        
        /*
        echo "probando saveNew() \n";
        print_r($user->saveNew("usuario4@pruabas.com", "pruebas4", 1, 1, ip2long(get_client_ip()), 1, "ES"));
        */
        
        echo "probando getAll() \n";
        print_r($db->getAll());
        
        
        
        
        
        echo "fin de la prueba \n";
        
        
        
        
        
    
    }catch(Exception $e){
        
        print_r($e);
        
        
    }
    
    
?>