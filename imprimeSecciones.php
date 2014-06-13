<?php
function imprimeSecciones(){
    $conexion = new ConexionDB();
    
    $secciones = $conexion->getConsulta("SELECT * FROM secciones");
    
    foreach($secciones as $seccion){
        echo "<li><a 
        id=\"".$seccion["idSeccion"]."\" 
        class=\"categoria\" 
        href=\"seccion.php?seccion=".$seccion["nombreSeccion"]."\"
        data-categoria= \"".$seccion["nombreSeccion"]."\">"
            .$seccion["nombreSeccion"]."</a></li>";
    }
}
?>