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
    <body id="padre">
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
                    <img src="publicidadsuperior.png">
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
                <!----------------------Extraccion de noticias---------------->
                <?php   
                
                                $seccion = $_GET["seccion"];
                                $conexion = new ConexionDB();

                                /*--------Obtenemos la noticia desde la base de datos--------*/
                                                                
                                $noticias=null;
                                //Filtramos las noticias para solo dejar las de cada seccion:
                                $consulta = "SELECT * from noticias WHERE (seccion = '".$seccion."') ORDER BY fecha DESC  LIMIT 7";
                                $noticias = $conexion->getConsultaArray($consulta);
                ?>
                <header id="titulo_categoria" class="titulo_categoria" data-categoria = "<?php echo $seccion?>"> <?php echo $seccion?></header>
                    
                    <!--NOTICIA DESTACADA-->

                <section id="noticia_destacada">
                    <?php imprimeNoticiaSeccion($noticias[0]);?>
                </section>    
                
                <section id="noticias">
                    
<!-------------------COLUMNA 1------------------->
                    
                    <section id="col_noticias_1" class="col_noticia">
                        
                        <?php imprimeNoticiaSeccion($noticias[1]);?>
                        <?php imprimeNoticiaSeccion($noticias[2]);?>
                        <?php imprimeNoticiaSeccion($noticias[3]);?>
                        <?php imprimeNoticiaSeccion($noticias[4]);?>
                    </section >
                    
<!-------------------COLUMNA 2------------------->
                    
                    <section id="col_noticias_2" class="col_noticia">
                        <?php imprimeNoticiaSeccion($noticias[5]);?>
                        <?php imprimeNoticiaSeccion($noticias[6]);?>
                    </section>
                    
<!-------------------COLUMNA 3------------------->
                    
                    <section id="col_noticias_3" class="col_noticia" >
                        <section id="noticias_relacionadas" data-scroll= "scroll" class="noticia">
                            <h1 id="titulo_ultimas_noticias">
                                Ultimas noticias
                            </h1>
                            <ul id="lista_ultimas_noticias">
                                <?php imprimeUltimasNoticias();?>
                            </ul>
                        </section>
                        <aside id="anuncios_publicitarios" class="publicidad">
                            <img src="anuncio.jpg">
                            <img src="publi_propia.png">
                        </aside>
                    </section>
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