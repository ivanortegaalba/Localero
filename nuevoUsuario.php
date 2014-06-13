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
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>  
        <script src="http://jquery.bassistance.de/validate/jquery.validate.js"></script>
        <script src="http://jquery.bassistance.de/validate/additional-methods.js"></script> 
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

                         
                        <form  id='nuevoUsuario' method="post" class="formulario" action="registrarUsuario.php">
                           <h1>Acceso a El Localero</h1>
                           <p>
                               <label for="usuario">Usuario</label>
                               <input name="usuario" id="usuario" type="text" />
                           </p>
                            <p>
                               <label for="contrasenia">Contrase&ntilde;a</label>
                               <input name="contrasenia" id="contrasenia" type="password" />
                           </p>
                            <p>
                               <label for="repcontrasenia">Repite la contrase&ntilde;a</label>
                               <input name="repcontrasenia" id="repcontrasenia" type="password" />
                           </p>
                            <p class="linea"></p>
                            <h1>Datos personales</h1>
                            <p>
                               <label for="nombre">Nombre</label>
                               <input name="nombre" id="nombre" type="text"  />
                           </p>
                            <p>
                               <label for="apellidos">Apellidos</label>
                               <input name="apellidos" id="apellidos" type="text" />
                           </p>
                           <p>
                               <label for="email">Correo</label>
                               <input name="email" id="email" type="text"/>
                           </p>
                            <p>
                               <label for="web">Sitio Web</label>
                               <input name="web" id="web" type="text"/>
                           </p>
                           <p>
                               <label for="telefono">Telefono</label>
                               <input name="telefono" id="telefono" type="text" />
                           </p>
                            <p>
                               <label for="fecha">F. Nacimiento</label>
                               <input name="fecha" id="fecha" type="date" />
                           </p>
                           
                            
                           <p><input type="submit" value="Confirmar" /></p>
                        </form>
                 <!------------------------SCRIPT PARA LA VALIDACIÓN DEL FORMULARIO-------------------------->      
                    <script type="text/javascript">
                                /* Esta función cambia los mensajes por defecto de validator()*/
                                    $(document).ready(function() {
                                        jQuery.extend(jQuery.validator.messages, {
                                              required: "Este campo es obligatorio.",
                                              email: "Por favor, escribe una dirección de correo válida",
                                              url: "Por favor, escribe una URL válida.",
                                              number: "Por favor, escribe un número de telefono válido.",
                                              equalTo: "Las contraseñas no coinciden",
                                              maxlength: jQuery.validator.format("Por favor, no escribas más de {0} caracteres."),
                                              minlength: jQuery.validator.format("Por favor, no escribas menos de {0} caracteres.")
                                            });
                                        });
                                /* Con esta función del plugin JQuery validate, comprobamos todos los campos de texto*/
                                        $(function(){
                                            $('#nuevoUsuario').validate({
                                                rules :{
                                                    usuario : {
                                                        required : true,
                                                        minlength : 3, 
                                                        maxlength : 9  
                                                    },
                                                    contrasenia : {
                                                        required : true
                                                        
                                                    },
                                                    repcontrasenia : {
                                                        required : true,
                                                        
                                                    },
                                                    nombre : {
                                                        required : true
                                                    },
                                                    apellidos : {
                                                        required : true
                                                    },
                                                    email : {
                                                        required : true, 
                                                        email    : true  
                                                    },
                                                    web : {
                                                        url    : true  
                                                    },
                                                    telefono : {
                                                        number : true   
                                                    },
                                                    fecha : {
                                                        required : true
                                                    }
                                                }
                                            });    
                                        }); 
                    </script>
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