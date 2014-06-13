<?php 

/* 
    Funcion que imprime una noticia, estructurada como un article. 
Solo se utiliza en la portada principal por el tipo de consulta que se hace para obtener noticias de diversas secciones
Recibe como parámetro un vector con los atributos de la noticia.
*/
function imprimeNoticia($noticia){
    $noticia=$noticia[0];
    echo "
            <article id=\"".$noticia["idNoticia"]."\" class=\"noticia\">
            <header class =\"titulo_noticia\">
                    <a href=\"noticia.php?idNoticia=".$noticia["idNoticia"]."\" data-categoria=\"".$noticia["seccion"]."\">
                        ".$noticia["titulo"]."</a>
            </header>";
                if($noticia["imagen"]!=null)
                    echo "<img src=\"../upload/"
                .$noticia["imagen"]."\" href=\"noticia.php?idNoticia=".$noticia["idNoticia"]."\">";
    echo "
                <p class=\"autor\">".$noticia["autor"]."</p>
                <p class=\"parrafo_noticia\">
                    ".$noticia["resumen"]."
                </p>
                <a id=\"editarButton\" class=\"editarButton\" hidden =\"hiden\" href=\"modificarNoticia.php?idNoticia=".$noticia["idNoticia"]."\">Editar</a>
                <a id=\"borrarButton\" class=\"borrarButton\" hidden =\"hiden\" href=\"borrarNoticia.php?idNoticia=".$noticia["idNoticia"]."\">Borrar</a>
            </article>";
}

/* 
    Funcion que imprime una noticia, estructurada como un article. 
Solo se utiliza en las secciones por el tipo de consulta que se hace para obtener noticias de una misma seccion
Recibe como parámetro un vector con los atributos de la noticia.
*/
function imprimeNoticiaSeccion($noticia){
    echo "
            <article id=\"".$noticia["idNoticia"]."\" class=\"noticia\">
            <header class =\"titulo_noticia\">
                    <a href=\"noticia.php?idNoticia=".$noticia["idNoticia"]."\" data-categoria=\"".$noticia["seccion"]."\">
                        ".$noticia["titulo"]."</a>
            </header>";
                if($noticia["imagen"]!=null)
                    echo "<img src=\"../upload/"
                .$noticia["imagen"]."\" href=\"noticia.php?idNoticia=".$noticia["idNoticia"]."\">";
    echo "
                <p class=\"autor\">".$noticia["autor"]."</p>
                <p class=\"parrafo_noticia\">
                    ".$noticia["resumen"]."
                </p>
                <a id=\"editarButton\" class=\"editarButton\" hidden =\"hiden\" href=\"modificarNoticia.php?idNoticia=".$noticia["idNoticia"]."\">Editar</a>
                <a id=\"borrarButton\" class=\"borrarButton\" hidden =\"hiden\" href=\"borrarNoticia.php?idNoticia=".$noticia["idNoticia"]."\">Borrar</a>
            </article>";
}

/*
    Imprime una lista no estructurada con las 5 últimas noticias que han sido creadas
*/
function imprimeUltimasNoticias(){
    $conexion = new ConexionDB();
    $ultimasNoticias = $conexion->getConsultaArray("SELECT idNoticia, titulo,seccion from noticias order by fecha limit 5");
    foreach($ultimasNoticias as $ultimaNoticia)
        echo "<li class=\"enlace_ultima_noticia\">
            <a href=\"noticia.php?idNoticia=".$ultimaNoticia["idNoticia"]."\">"
            .$ultimaNoticia["titulo"]."
            </a></li>";
}
/*
    Imprime una lista con 5 noticias de su seccion, esas noticias son aleatorias, pero pertenecientes a una seccion determinada.
Recibe como parametro la seccion a la que queremos que pernezcan las noticias generadas.
*/
function imprimeNoticiasRelacionadas($seccion){
    $conexion = new ConexionDB();
    $ultimasNoticias = $conexion->getConsultaArray("SELECT * from noticias WHERE (seccion = '".$seccion."') ORDER BY RAND()  LIMIT 5");
    foreach($ultimasNoticias as $ultimaNoticia)
        echo "<li class=\"enlace_ultima_noticia\">
            <a href=\"noticia.php?idNoticia=".$ultimaNoticia["idNoticia"]."\">"
            .$ultimaNoticia["titulo"]."
            </a></li>";
}

?>