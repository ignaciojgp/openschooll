<?php
    header("content-type:text/javascript");
    include_once("../core/core.php");
    include_once("../model/themeSubscription.class.php");

    echo "probando suscripciones \n";
    
    
    
    
    
   
    
    try{
        
        $model = new ModelThemeSubscription();
        
        echo "probando getFirst() \n";
        print_r($model->getStudents(3));
        
        
        echo "fin de la prueba \n";
        
    
    }catch(Exception $e){
        
        print_r($e);
        
        
    }
    
    
?>