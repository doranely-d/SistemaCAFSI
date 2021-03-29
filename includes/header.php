<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/estilo.css" type="text/css">
        <link rel="stylesheet" href="css/css.css" type="text/css">

        <title>Centro de Atención en Fisioterapia y Salud Integral (C.A.F.S.I)</title>
        <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.1.js"></script>

    </head>
    <body>
        <header>
            <div class="navbar navbar-inverse "  role="navigation">
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="container">
                    <div id="logoF">
                        <a href="index.php">
                            <img src="img/uaqi.png" width="60" height="80">
                        </a>
                    </div>
                    <div class="navbar-header">
                        <h2><small>UNIVERSIDAD AUTÓNOMA DE QUERÉTARO</small></h2>
                        Centro de Atención en Fisioterapia y Salud Integral<br>
                        Licenciatura en Fisioterapia
                    </div>
                    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="http://www.uaq.mx/" target="_blank">UAQ</a></li>
                            <li><a href="http://www.uaq.mx/enfermeria/" target="_blank">Fac. Enfermeria</a></li>
                            <li><a href="mostrar_menu_principal.php" class="glyphicon  glyphicon-home btn-lg" data-toggle="tooltip" data-placement="left"  title="Inicio"></a></li>
                            <li> <a href="#" target="_blank"></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">  
                                    <?php
                                    session_start();
                                    if (isset($_SESSION["id"])) {
                                        ?>
                                        <?php
                                        echo($_SESSION["nombre"]);
                                    } else {
                                        if (isset($_GET["session_init"])) {
                                            if ($_GET["session_init"] == 0) {
                                                header("Location: index.php?session_init=1");
                                            }
                                        } else {
                                            header("Location: index.php?session_init=1");
                                        }
                                    }
                                    ?><b class="caret "></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="index.php">Iniciar Sesión</a></li>
                                    <li class="divider"></li>
                                    <li><a href="mailto:jacques@uaq.edu.mx">Reportar problema</a></li>
                                    <li class="divider"></li>
                                    <li><a href="./cerrar_sesion.php">Cerrar Sesión</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <script type="text/javascript" src="js/script.js"></script>
        <section id="contenido">
            <div class="container">
                <div class="jumbotron">
