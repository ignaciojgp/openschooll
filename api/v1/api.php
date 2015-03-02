<?php

require_once '../../core/core.php';

require_once 'OpenshoolAPI.class.php';

// Requests from the same server don't have a HTTP_ORIGIN header
if (!array_key_exists('HTTP_ORIGIN', $_SERVER)) {
    $_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];
}



try {
    
    $API = new OpenshoolAPI($_REQUEST['request'], $_SERVER['HTTP_ORIGIN']);
    echo $API->processAPI();
    
} catch (Exception $e) {
    
     
    echo json_encode(Array('error' => $e->getMessage()));
}

?>