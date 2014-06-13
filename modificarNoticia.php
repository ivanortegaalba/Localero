<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
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
                <section class="formulario">
                    
<!----------COLUMNA 1----------------->
                        <form enctype="multipart/form-data" action= 'registrarNoticia.php' method="POST">
                            <p><label for="seccion">Secci&oacute;n</label> 
                                
                            <?php

                                $conexion = new ConexionDB();
                                $idNoticia = $_GET["idNoticia"];

                                /*--------Obtenemos la noticia desde la base de datos--------*/
                                $consulta = 'SELECT * from noticias WHERE (idNoticia =\''.$idNoticia.'\')';
                                $noticia = $conexion->getConsultaArray($consulta);
                                $noticia = $noticia[0];

                                $titulo = $noticia["titulo"];
                                $seccion = $noticia["seccion"];
                                $resumen = $noticia["resumen"];
                                $cuerpo = $noticia["cuerpo"];
                                $fecha = $noticia["fecha"];
                                $autor = $noticia["autor"];
                                $imagen = $noticia["imagen"];

                                /*--------Sacamos las secciones de forma dinámica--------*/
                                $resultado = $conexion ->getConsulta("SELECT nombreSeccion from secciones");

                                echo '<select name = "seccion">';
                                foreach ($resultado as $nomSeccion)
                                    echo "<option value='$nomSeccion[0]'>$nomSeccion[0]</option>"; 
                                echo '</select>';

                            ?>
                            </p>
                            <p>
                            <input type="hidden" name="idNoticia" value="<?php echo $idNoticia;?>">
                            <label for="titulo">Titular</label>
                            <input type="text" name="titular" id="titular" value="<?php echo $titulo?>" />
                            </p>
                            <p><label for="resumen">Resumen (Max. 300 caracteres)</label> </p>
                            <textarea name="resumen" id="resumen" ><?php echo $resumen?></textarea>
                            <p><label for="cuerpo">Texto Noticia (Max. 800 caracteres)</label></p> 
                            <textarea name="cuerpo" id="cuerpo" cols="500" rows="500"><?php echo $cuerpo?></textarea>
                            <p><label for="fecha">Fecha</label> 
                            <?php 
                                echo "<input type='date' name='fecha' id='fecha' value='".$fecha."'/>"; 
                            ?>
                            <label for="autor">Autor</label> 
                            <input type="text" name="autor" id="autor" value="<?php echo $autor ?>" />
                                </p>
                            <p>
                            <img src="../upload/<?php echo $imagen ?>" >
                            <p><label for="imagen" >Imagen actualmente en uso, para cambiarla suba otra:</label><p>
                            <input type="file" name="imagen" id="imagen" />
                            </p>
                            <input type="submit" name="boton" id="boton" 
                            value="Modificar"  /> 
                        </form> 
                    </section>
            </aside>
    
            <aside id="derechapubli" class="publicidad">
                <img src="publicidad_lateral.png">
            </aside>

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