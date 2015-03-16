<?php
    header("content-type:text");
    include_once("../core/core.php");
    include_once("../model/user.class.php");

    echo "probando usuario \n";
    
    
    
    
    
   
    
    try{
        
        $user = new ModelUser();
        
        
        /*
        echo "probando setTokenForReset() \n";
        print_r($user->setTokenForReset("ignaciojpg@gmail.com"));

        */
        
        
        echo "probando getFirst() \n";
        print_r($user->getFirst("ignaciojpg@gmail.com","kalil1983"));
        
        
        /*
        echo "probando saveNew() \n";
        print_r($user->saveNew("usuario4@pruabas.com", "pruebas4", 1, 1, ip2long(get_client_ip()), 1, "ES"));
        */
        
        //echo "probando setNewPassword() \n";
        //print_r($user->setNewPassword("ignaciojpg@gmail.com", "kalil1983","b6a9e2bec4a62e78a76166a5538e5ab3"));
        //
        
        
        
        
        echo "fin de la prueba \n";
        
        
        
        
        
    
    }catch(Exception $e){
        
        print_r($e);
        
        
    }
    
    
?>