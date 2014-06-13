<?php
    include_once('conexionDB.php');
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    $conexion = new ConexionDB();
    $consulta = "DELETE FROM noticias WHERE idNoticia=".$_GET["idNoticia"];
    $conexion->insertConsulta($consulta);
    header("Location: ".$_SERVER['HTTP_REFERER']);
?>