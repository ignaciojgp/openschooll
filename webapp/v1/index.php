<?php
    include_once "../../core/core.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>title</title>
    
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen"/>
    <link href="css/openschool.css" rel="stylesheet" media="screen"/>
    
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/angular.min.js"></script>
    <script type="text/javascript" src="js/openschool.js"></script>
    
    <meta charset="UTF-8">
    <meta name="description" content="Free Web School">
    <meta name="keywords" content="HTML,CSS,XML,JavaScript">
    <meta name="author" content="Ignacio J González Pérez">
    
</head>
<body>
    
    
    <nav class="navbar navbar-default container">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="#">
              OpenSchool
            </a>
          </div>
          
          
          <div class="navbar-right">
                <form class="navbar-form">
                    <label>Login <input type="text" placeholder="email" class="form-control"/></label>
                    <input type="password" placeholder="password" class="form-control"/>
                    <input type="button" class="form-control btn btn-primary" value="ingresar"/>
                    
                </form>
          </div>
        </div>
    </nav>
    
    <div class="container" id="mainContainer">
        <div class="jumbotron row">
            <h1>Welcome to Openschool</h1>        
        </div>
        
        <section class="row">
            <article class="col-sm-4">
                <h2>Aprende Fácil</h2>
                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis in nunc in diam auctor luctus. Donec vehicula ex sagittis sollicitudin suscipit. Nam ornare cursus diam, vulputate scelerisque eros mattis eu. Pellentesque scelerisque felis in aliquam rutrum. Pellentesque nec fringilla metus. Sed sodales commodo nulla, ut egestas lorem faucibus sed. Donec eu nunc a ex sagittis eleifend. Morbi fringilla in justo eget pretium. Nulla nisi massa, volutpat ut ipsum quis, tempor euismod lectus. Nullam ullamcorper, tellus a tincidunt consequat, neque urna euismod mauris, at tincidunt elit nisi eget sem. Curabitur tempor venenatis viverra. Donec mollis purus non felis commodo, id faucibus felis fringilla. Proin porttitor porta bibendum.</div>
            </article>
            
            <article class="col-sm-4">
                <h2>Aprende Donde Quieras</h2>
                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis in nunc in diam auctor luctus. Donec vehicula ex sagittis sollicitudin suscipit. Nam ornare cursus diam, vulputate scelerisque eros mattis eu. Pellentesque scelerisque felis in aliquam rutrum. Pellentesque nec fringilla metus. Sed sodales commodo nulla, ut egestas lorem faucibus sed. Donec eu nunc a ex sagittis eleifend. Morbi fringilla in justo eget pretium. Nulla nisi massa, volutpat ut ipsum quis, tempor euismod lectus. Nullam ullamcorper, tellus a tincidunt consequat, neque urna euismod mauris, at tincidunt elit nisi eget sem. Curabitur tempor venenatis viverra. Donec mollis purus non felis commodo, id faucibus felis fringilla. Proin porttitor porta bibendum.</div>
            </article>
            
            <article class="col-sm-4">
                <h2>Sólo Regístrate</h2>
                <form class="register">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Contraseña</label>
                      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Contrasela">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Confirma tu contraseña</label>
                      <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Confirma tu contraseña">
                    </div>
                    <div class="form-group row">
                        <label class="col-xs-5" for="exampleInputPassword1"><img src="captcha.php" alt="capcha"/></label>
                        <div class="col-xs-2"><a href="#" class="btn btn-default"><span class="glyphicon glyphicon-refresh"></span></a></div>
                        <div class="col-xs-5"><input type="text" class="form-control" id="exampleInputPassword1" placeholder="captcha"></div>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox"> Acepta los <a href="terminos-condiciones.html">términos y condiciones</a>
                      </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Registrarme</button>
               </form>
            </article>
        </section>
    </div>
    
    <div class="footer container">
        
        
        <?php
            echo $_SESSION['captcha'];
        ?>
        Openschool, es una iniciativa sin fines de lucro 
        
    </div>
    
    
    
</body>
</html>