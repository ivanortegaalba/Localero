<?php
    include_once('conexionDB.php');

    $mysql = new ConexionDB();
    $usuario = $_POST["usuario"];
    $usuario = $_POST["password"];
    $consulta="SELECT usuario from usuarios WHERE (usuario='".$usuario."')";
    $resultado=$mysql->getConsultaArray($consulta);
    if($resultado[0]["usuario"]==$usuario){
        session_start(); 
        $_SESSION["usuario"]=$usuario;
        $_SESSION["estado"]=1;
        header("Location:".$_SERVER['HTTP_REFERER']); 
    }else{
        header("Location:".$_SERVER['HTTP_REFERER']); 
    }
        
    
?>