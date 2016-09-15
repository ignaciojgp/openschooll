<?php
    header("content-type:text/javascript");
    include_once("../core/core.php");
    include_once("../model/themeauthor.class.php");

    echo " \n probando theme \n";
    
    
    try{
        
        $db = new ModelThemeAuthor();
       
	// $res = $db->getByUser(3);
	$res = $db->setCreatorToTheme(3,14);
       
        print_r($res);
        
        echo " \n fin de la prueba \n";
        
        
        
        
        
    
    }catch(Exception $e){
        
        print_r($e);
        
        
    }
    
    
?>