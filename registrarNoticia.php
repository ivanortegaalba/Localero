<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf8" />
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
            include_once 'imprimeNoticia.php';
            include_once 'imprimeSecciones.php';
            
            session_start();
                if (isset($_SESSION["estado"]) && $_SESSION["estado"]==1)  
                    if($_SESSION["usuario"] == "admin"){
                        echo "<script src='aspectoAdmin.js'></script>";
                    }else{
                    echo "<script src='aspectoUser.js'></script>";
                    }
        ?>
        <aside id="contenedorprincipal">
            <aside id="izquierdapubli" class="publicidad">
            <img src="publicidad_lateral.png">
            </aside>
            <aside id="contenidocentral">
                <aside id="toppubli" class="publicidad">
                    <img src="/publicidad_superior.png">
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
                <section class="formulario">
                    
<!----------Procesado del registro de la noticia----------------->
                        <?php
                            error_reporting(E_ALL);
                            ini_set('display_errors', '1');
                            $conexion = new ConexionDB();
                            
                            $titular = $_POST["titular"];
                            $autor = $_POST["autor"];
                            $resumen =$_POST["resumen"];
                            $fecha =$_POST["fecha"];
                            $cuerpo =$_POST["cuerpo"];
                            $seccion = $_POST["seccion"];
                            $imagen = $_FILES["imagen"]["name"];

                            if($_POST["boton"] == "Modificar"){
                                $idNoticia = $_POST["idNoticia"];
                                $consulta = 'UPDATE noticias SET(
                                    seccion=\''.$seccion.'\',
                                    titular=\''.$titular.'\',
                                    autor=\''.$autor.'\',
                                    resumen=\''.$resumen.'\',
                                    cuerpo=\''.$cuerpo.'\',
                                    fecha=\''.$fecha.'\',
                                    imagen=\''.$imagen.'\')
                                    WHERE idNoticia=\''.$idNoticia.'\';';
                            }else{
                                $consulta = 'INSERT INTO noticias VALUES(\' \',
                                \''.$seccion.'\',
                                \''.$titular.'\',
                                \''.$autor.'\',
                                \''.$resumen.'\',
                                \''.$cuerpo.'\',
                                \''.$fecha.'\',
                                \''.$imagen.'\');';
                            }
                                //comprobamos si ha ocurrido un error.
                            if ($_FILES['imagen']['error'] > 0){
                                echo "ha ocurrido un error";
                            } else {
                                $ruta = '/home/77364563/public_html/upload/';
                                $ruta = $ruta . basename( $imagen); 
                                if(move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta)) { 
                                    echo "El archivo ". basename( $_FILES['imagen']['name']). " ha sido subido";
                                } else{
                                echo "Ha ocurrido un error, trate de nuevo!";
                                }
                            }
                            if($conexion->insertConsulta($consulta)){
                                echo' <aside class="exito"><img id ="iconoOK" src="http://imageshack.com/a/img268/4143/c3c7.png">La noticia ha sido creada correctamente</aside>';
                                echo"
                                <article id='noticia_destacada' class='noticia' >
                                    <header id='titulo_noticia_destacada' class ='titulo_noticia' >
                                        <a href='$seccion/$ruta'  id='titulo_noticia_destacada' class                   ='titulo_noticia'>$titular</a>
                                    </header>
                            <img src='../upload/$imagen'>
                            <p class='autor'>$autor</p>
                            <p class='parrafo_noticia_destacada'>
                                $cuerpo
                                </p>
                                </article>";
                            }
                        ?>
<!----------------------------------------------------------------------------------------------------------------->          
                    </section>
            </aside>
    
            <aside id="derechapubli" class="publicidad">
                <img src="publicidad_lateral.png">
            </aside>

    <footer id="footer">
        <details>
            
        <summary>MÁS INFORMACIÓN </summary>
            
            <address ><p>C/Profesor Vicente Callao 3</p><p> 18011 Granada (España)</p> </address>
            <p> Desarrollado por: Ivan Ortega Alba</p>
            <a href="/como-se-hizo.pdf"> Como se hizo</a>
            <p></p>
        </details>
    </footer>

</aside>
    </body>
</html>
