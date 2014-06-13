<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Localero</title>
        <link rel="stylesheet" type="text/css" href="index.css" />
<!--        Fuentes importadas desde google fonts-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Libre+Baskerville' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Oswald:700' rel='stylesheet' type='text/css'>  
        <link href="icono_pesta%C3%B1a.png" type="image/x-icon" rel="shortcut icon" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>        
        <script src="ventanalogin.js"></script>
    </head>
    <body>
        <?php 
            error_reporting(E_ALL);
            ini_set('display_errors', '1');
            include_once 'conexionDB.php';
            include_once 'imprimeSecciones.php'
        ?>
        <aside id="contenedorprincipal">
            <aside id="izquierdapubli" class="publicidad">
            <img src="publicidad_lateral.png">
            </aside>
            <aside id="contenidocentral">
                <aside id="toppubli" class="publicidad">
                    <img src="publicidad_superior.png">
                </aside>
                <header>
                    <img id="nombreperiodico" src="banner_nombre_2.png">
                </header>
                <nav>
                        <ul id="menuCategorias">
                            <li><a id="index" class="categoria" href="index.php">Portada</a></li>
                            <?php imprimeSecciones(); ?>
                            <li><a id="nuevaButton" class="categoria" href="nuevaNoticia.php" hidden="hidden">Nueva</a></li>
                            <li><a id="logoutButton" class="categoria" href="cerrarLogin.php" hidden="hidden">Logout</a></li>
                            <li><a id="loginButton" class="categoria" href="#">Login</a></li>
                            <li><a id="singupButton" class="categoria" href="nuevoUsuario.php">Sing up</a></li>
                        </ul>
                    </nav>
                <!---------------------------------------------Login deslplegable-------------------------------------------->
                    <aside id="loginBox" class ="noticia">
                        <form method="post" action="validarLogin.php">
                            <input type="text" name="usuario" id="usuarioLogin" value="Usuario"  onclick="this.value=''"/>
                            <input type="password" name="password" id="passwordLogin" value="Password"  onclick="this.value=''" />
                            <button type="submit" class="buttonsubmit" >
				                <img id ="iconoOK" src="http://imageshack.com/a/img268/4143/c3c7.png"  >
			                 </button>
                        </form>
                    </aside>
                
                    
<!----------COLUMNA 1----------------->

                    <aside class="formulario">
                        <?php
/*-------------Registro de un nuevo usuario en la base de datos----------------*/
                            error_reporting(E_ALL);
                            ini_set('display_errors', '1');

                            include_once 'conexionDB.php';

                            $mysql = new ConexionDB();

                            $usuario = $_POST["usuario"];
                            $contrasenia = $_POST["contrasenia"];
                            $nombreUsuario = $_POST["nombre"];
                            $apellidosUsuario = $_POST["apellidos"];
                            $correoUsuario =$_POST["email"];
                            $webUsuario =$_POST["web"];
                            $telUsuario = $_POST["telefono"];
                            $fnacimientoUsuario =$_POST["fecha"];

                            $consulta = 'INSERT INTO usuarios VALUES(\' \',\''
                                .$usuario.'\',\''
                                .$contrasenia.'\',\''
                                .$nombreUsuario.'\',\''
                                .$apellidosUsuario.'\',\''
                                .$correoUsuario.'\',\''
                                .$webUsuario.'\',\''
                                .$telUsuario.'\',\''
                                .$fnacimientoUsuario
                                .'\')';

                            if ($mysql->insertConsulta($consulta)) {
                                echo' <aside class="exito"><img id ="iconoOK" src="http://imageshack.com/a/img268/4143/c3c7.png">Su registro se ha completado correctamente</aside>';
                                echo "<h2>".$nombreUsuario." ". $apellidosUsuario."</h2>
                                <img id ='success' src='http://southforwinter.weebly.com/uploads/9/4/3/8/9438873/8901510_orig.png?443'>
                                <h2> Ahora es parte de la familia de El Localero</h2>
                                <h2> Podrá logearse y empezar a comentar nuestras noticias</h2>
                                ";
                            } else {
                                echo"Error al insertar datos";
                            }
                        ?>

            </aside>
            </aside>
    
            <aside id="derechapubli" class="publicidad">
                <img src="publicidad_lateral.png">
            </aside>

    <footer id="footer">
        <details>
            
        <!---------------FOOTER------------------>
            
            <footer id="footer">
    <aside class="cajaBotones">
            <a class="botonesFooter" href="formulario.html"> Suscribete</a>
            <a class="botonesFooter" type="email" href="ivanortegaalba@gmail.com"> Contacto</a>
            <a class="botonesFooter" href="como-se-hizo.pdf"> Como se hizo</a>
    </aside>
    <aside class="informacionPersonal">
            <p>Tecnologías Web, 3º Grado en Ingeniería Informática (TIC)</p>
            <address><p>C/Profesor Vicente Callao 3, 18011 Granada (España)</p> </address>
            <p> Desarrollado por: Ivan Ortega Alba</p>
    </aside>
    <aside id="social">
        <p>
            <a href="mailto:contacto@periodico.com">@</a>
            <a href="https://plus.google.com/u/0/+IvanOrtegaAlba/posts"> g+</a>
            <a href="http://lnkd.in/dbypqWX">Ln</a>
        </p>
    </aside>
    </footer>

</aside>
    </body>
</html>




