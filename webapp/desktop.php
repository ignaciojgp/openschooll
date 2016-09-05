<?php
    include_once('../core/core.php');
    
    if(!isset($_SESSION['myuser'])){
        header('location: index.php');
    }else{
        
        $myuser = $_SESSION['myuser'];
    }
    
?>
<!DOCTYPE html>
<html ng-app="openschoolApp">
<head>

 	<meta charset="UTF-8">
    <meta name="description" content="Free Web School">
    <meta name="keywords" content="HTML,CSS,XML,JavaScript">
    <meta name="author" content="Ignacio J González Pérez">
    
    <title>title</title>
    
        
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen"/>
    <link href="css/desktop.css" rel="stylesheet" media="screen"/>
    
    <!--  librerias  -->
    <script type="text/javascript" src="js/libs/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="js/libs/bootstrap.js"></script>
    <script type="text/javascript" src="js/libs/angular.min.js"></script>
    <script type="text/javascript" src="js/libs/sanitize.js"></script>
	
	
	<!--  servicios  -->
    <script type="text/javascript" src="js/openschoolapi.service.js"></script>

	<!--  modulos  -->
	<script type="text/javascript" src="js/menu/module.menu.js"></script>
    <script type="text/javascript" src="js/courses/course.controller.js"></script>
    <script type="text/javascript" src="js/desktop/theme/module.themes.js"></script>
    <script type="text/javascript" src="js/desktop/leason/module.leason.js"></script>
    <script type="text/javascript" src="js/desktop/desktop.controller.js"></script>
        
        
</head>
<body ng-controller="PageController">
    <nav class="navbar navbar-default container">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
                    OpenSchool
                </a>
            </div>
          
          
            <ul class="nav navbar-nav navbar-right">
                
                <li class="dropdown">
                    <a class="dropdown-toggle" type="button" id="userOptionsMenu" data-toggle="dropdown" aria-expanded="true">
                        Usuario: {{user.email}} <span class="glyphicon glyphicon-cog"></span>
                        
                    </a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="userOptionsMenu">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Perfil</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="close-session.php">Cerrar sesion</a></li>
                        
                    </ul>
                </li>
            </ul>
      
        </div>
    </nav>
    <main-menu options="user.menu" selection="menuSelectedOption"></main-menu>
    <div class="container">
    	<div ng-show="seccion == null" class="text-center">Seleccione una pantalla</div>
	
		<ng-include src="seccion"></ng-include>
	
    </div>
    
    
    
    <div class="footer container">
        
        Openschool, es una iniciativa sin fines de lucro 
        
    </div>
    
</body>
</html>