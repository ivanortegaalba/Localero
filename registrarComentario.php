<?php 

include 'conexionDB.php';

$conexion= new ConexionDB;
session_start();

$comentario=$_POST['contenidoComentario'];
$fecha = date("Y-m-d H:i:s");
$autor = $_SESSION['usuario'];
$idNoticia = $_POST['idNoticia'];

    $conexion->insertConsulta("INSERT INTO comentarios VALUES (' ','$idNoticia','$autor','$fecha','$comentario')");
?>
