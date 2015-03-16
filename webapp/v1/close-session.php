<?php

    session_start();
    
    unset($_SESSION['myuser']);
    
    session_destroy();
    
    
    header('location: index.php');
    
?>