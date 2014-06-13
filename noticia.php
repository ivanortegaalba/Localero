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
        <script src="http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js"></script>
        <script src="ventanalogin.js"></script>
    </head>
    <body>
<!-----------------------CONTROL DE SESIÓN------------------->
        <?php 
            error_reporting(E_ALL);
            ini_set('display_errors', '1');

            include_once 'conexionDB.php';
            include_once 'imprimeNoticia.php';
            include_once 'imprimeSecciones.php';
            include_once 'imprimeComentarios.php';

            session_start();

                if (isset($_SESSION["estado"]) && $_SESSION["estado"]==1)  
                    if($_SESSION["usuario"] == "admin"){
                        echo "<script src='aspectoAdmin.js'></script>";
                    }else{
                    echo "<script src='aspectoUser.js'></script>";
                    }
        ?>
<!--------------------------------------------------------------->
        <aside id="contenedorprincipal">
            <aside id="izquierdapubli" class="publicidad">
            <img src="/~77364563/periodicoII/publicidad_lateral.png">
            </aside>
            <aside id="contenidocentral">
                <aside id="toppubli" class="publicidad">
                    <img src="/~77364563/periodicoII/publicidad_superior.png">
                </aside>
                <header>
                    <img id="nombreperiodico" src="/~77364563/periodicoII/banner_nombre_2.png">
                </header>
                 <!---------------------------------------------Barra de navegación-------------------------------------------->
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
                 <?php   
                                $conexion = new ConexionDB();
                                $idNoticia = $_GET["idNoticia"];

                                /*--------Obtenemos la noticia desde la base de datos--------*/
                                $consulta = 'SELECT * from noticias WHERE (idNoticia =\''.$idNoticia.'\')';
                                $noticias = $conexion->getConsulta($consulta);

                                foreach ($noticias as $noticia){
                                    $titulo = $noticia["titulo"];
                                    $seccion = $noticia["seccion"];
                                    $resumen = $noticia["resumen"];
                                    $cuerpo = $noticia["cuerpo"];
                                    $fecha = $noticia["fecha"];
                                    $autor = $noticia["autor"];
                                    $imagen = '../upload/'.$noticia["imagen"];
                                }
                ?>
                    
<!----------COLUMNA 1----------------->
                   
                    <section id="col_noticia_principal" class="col_noticia_principal">
                        <article id="<?php echo $idNoticia; ?>" class="noticia" >
                            <header  class ="titulo_noticia">
                                <a id="titulo_noticia_destacada" class="titulo_noticia" href="noticia.php?idNoticia=<?php echo $idNoticia ?>"><?php echo $titulo; ?></a>
                            </header>
                            
<!--------------------------- tooltip element ---------------------------->
                                <aside class="tooltip">
                                  <ul id="lista_ultimas_noticias">
                                    <?php imprimeNoticiasRelacionadas($seccion);?>
                                    </ul>

                                </aside>

                            <script> $("#titulo_noticia_destacada").tooltip({ effect: 'slide', 
                                                                             direction:'left',
                                                                             position: 'bottom center',
                                                                            opacity: 0.9,
                                                                            }); 
                            </script>
<!----------------------------------->
                            
                            <img src="<?php echo $imagen;?>">
                            <p class="autor"><?php echo $autor; ?></p>
                            <p class="parrafo_noticia_principal">
                                <?php echo $resumen; ?>
                            </p>
                            <section class="parrafo_noticia_principal">
                               <?php echo $cuerpo; ?>
                                </section>
                        </article>
<!--------------COMENTARIOS---------------->
                         <section id="comentarios" class="noticia" data-scroll="scroll">
                             <!--------------FORMULARIO NUEVOS COMENTARIOS---------------->  
                             
                             <form  method="post" class="formulario_comentario" hidden="hidden" action="">
                           <h1>Comentar</h1>
                               <textarea  id="cajaTextoComentario" name="comentario" required placeholder="Deja aquí tu comentario"></textarea><p>
                           </p>
                           <p><input id="enviarButton" name="enviarButton" type="button" value="Agregar Comentario" /></p>
                                 
                                 <!--------------SCRIPT AJAX---------------->
                                 
                            <script type="text/javascript">
                                 /**
*Este script está encargado de obtener las variables necesarías para la creación del comentario, junto con el comentario introducido por el usuario, y mandarlo mediante ajax a *un .php por post, y que este guarde dicho comentario. Gracias a AJAX esto podrá hacerse de forma asincrona sin necesidad de recargar la página
*Está nombrado como php, aunque su contenido en la mayoría es jQuery. 
**/

$(document).ready(function() {

                                    $("#enviarButton").click(function() {
                                        var usuario = <?php echo '\''.$_SESSION['usuario'].'\''; ?>;
                                        var idNoticia = <?php echo $_GET['idNoticia']?>;
                                        var contenidoComentario = $("#cajaTextoComentario").val();
                                        var ahora = new Date();
                                        var fecha = ahora.getDate() + '-' +ahora.getMonth() + '-' + ahora.getFullYear() + ' ' + ahora.getHours() + ':' + ahora.getMinutes() + ':' +ahora.getSeconds();
                                        var variables = 'contenidoComentario='+contenidoComentario+'&idNoticia='+idNoticia; 
                                        /*Podemos pasar más valores concatenando con &variable=valor*/

/**
*Mandamos por Ajax el contenido del comentario, el contenido del comentario y el idNoticia, el autor y la fecha puede obtenerla PHP.
*El guardado en base de datos se hace en registrarComentario.php
**/

                                        $.ajax({
                                            type: "POST",
                                            url: "registrarComentario.php",
                                            data: variables,
                                            success: function() {
                                                $('#comentarios').append('<article class="comentarioProducido"><header><a href="#">'+usuario+
                                                                         '</a> el <time datetime="'+ahora+'">'+fecha+'</time></header><p>'+
                                                                         contenidoComentario+'</p></article>');
                                                $('.comentarioProducido').css('word-wrap', 'break-word');
                                            }                          
                                        });
                                        return false;
                                    });
                                });
                                 </script>
                        
                                 <!-------------------COMENTARIOS TRAÍDOS DE LA BD-------------------->
                                 
                             </form>
                            <h1 id="cabecera_comentarios">
                                Comentarios de otros localeros
                            </h1>
                            <section id="comentariosDinamincos">
                                 <section id="comentariosUsuarios" >
                                    <?php imprimeComentariosNoticia($_GET['idNoticia']); ?>
                                </section>
                            </section>
                        </section>
                        

                    </section >
                    
<!-----------COLUMNA 2-------------->
                    
                    <section id="col_noticias_relacionadas" class="noticia">
                        <section id="ultimas_noticias">
                            <h1 id="titulo_ultimas_noticias">
                                Noticias relacionadas
                            </h1>
                            <ul id="lista_ultimas_noticias">
                                <?php imprimeNoticiasRelacionadas($seccion);?>
                            </ul>
                        </section>
                        <aside id="anuncios_publicitarios" class="publicidad">
                            <img src="/~77364563/periodicoII/publi_propia.png">
                        </aside>
                    </section>
                
            </aside>
    
            <aside id="derechapubli" class="publicidad">
                <img src="/~77364563/periodicoII/publicidad_lateral.png">
            </aside>

    <footer id="footer">
        <a href="/~77364563/periodicoII/formulario.html"> Suscribete</a>
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