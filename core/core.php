<?php

    include_once("sqlconnection.class.php");
    include_once("../model/user.class.php");

    $settings = parse_ini_file("../settings.ini", true);


    if($settings['enviroment']['debugmode'] == true){
        error_reporting(E_ALL);
        ini_set('error_reporting', E_ALL);
        ini_set('display_errors',1);
    }
    
    
    print_r($settings);
    
    try{
        
        $dbuser = new user();
        
        print_r( $dbuser->getAll());
        
    }catch(Exception $e) {
        echo "operando mal";
        
    }
    
    
    
    
    
    
    

?>