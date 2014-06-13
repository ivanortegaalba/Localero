<?php
function imprimeComentariosNoticia($idNoticia){
    $conexion = new ConexionDB();
    $consulta="SELECT * FROM comentarios WHERE idNoticiaPertenece = ".$idNoticia." ORDER BY fechaComentario DESC";
    $comentarios = $conexion->getConsulta($consulta);
    
    foreach ($comentarios as $comentario){
        echo "<article id='".$comentario['idComentario']."'><header><a href=\"#\"class='autor'>".$comentario['autorComentario']."</a> el <time>".$comentario['fechaComentario']."</time></header><p id='textoComentario'>".$comentario['textoComentario'].'</p><a href="borrarComentario.php?idComentario='.$comentario["idComentario"].'" hidden="hidden" class="editarUser">Borrar</a></article>';
    }
}