<?php
    include_once('../../core/core.php');
    
    if(!isset($_SESSION['myuser'])){
        header('location: index.php');
    }else{
        
        $myuser = $_SESSION['myuser'];
        
        
        
        
    }
    
?>
<!DOCTYPE html>
<html ng-app="openschoolApp">
<head>
    <title>title</title>
    
        
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen"/>
    <link href="css/desktop.css" rel="stylesheet" media="screen"/>
    
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/angular.min.js"></script>
    <script type="text/javascript" src="js/sanitize.js"></script>
    <script type="text/javascript" src="js/module.themes.js"></script>
    
    <script type="text/javascript" src="js/desktop.controller.js"></script>
    
    <meta charset="UTF-8">
    <meta name="description" content="Free Web School">
    <meta name="keywords" content="HTML,CSS,XML,JavaScript">
    <meta name="author" content="Ignacio J González Pérez">
        
        
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
    
    <div class="desktop container">
        <div class="col-sm-3">
            <h2>Cursos</h2>
            <theme-list></theme-list>
        </div>
        
        <div class="col-sm-9">
            <ul class="nav nav-tabs nav-justified">
                <li role="presentation" ng-class="{ 'active' : vista==0 }"><a href="#" ng-click=" vista=0">Curso</a></li>
                <li role="presentation" ng-class="{ 'active' : vista==1 }"><a href="#" ng-click=" vista=1">Lección</a></li>
                
            </ul>
            <theme-detail ng-show="vista==0 && selectedTheme!=null"></theme-detail>
            
            <div ng-show="vista==1">
                
                
                
                <lesson-detail ></lesson-detail>
            </div>
        </div>
        
         
        
    </div>
    
    
    
    <div class="footer container">
        
        Openschool, es una iniciativa sin fines de lucro 
        
    </div>
    
</body>
</html>