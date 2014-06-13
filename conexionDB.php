<?php

class ConexionDB{
    
    private $conexion;
    
    public function __construct() {
        try{
            $this->conexion = new PDO("mysql:host=localhost;dbname=77364563", "77364563", "77364563x");
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Conexión fallida". $e->getMessage();
        }
    }
    function __destruct() {
        $this->conexion = null;
    }
            
    function getConsulta($consulta){
         try{
            $resultado = $this->conexion->query($consulta);
        } catch (PDOException $e){
            echo "Inserción fallida". $e->getMessage();
        }
        return $resultado;
    }
    function insertConsulta($consulta){
        try{
            $this->conexion->query($consulta);
        } catch (PDOException $e){
            echo "Inserción fallida". $e->getMessage();
            return false;
        }
        return true;
    }
    function getConsultaArray($consulta){
        try{
            $consultaP=$this->conexion->prepare($consulta);
            $consultaP->execute();
            $resultado = $consultaP->fetchAll();
        } catch (PDOException $e){
            echo "Inserción fallida". $e->getMessage();
        }
        return $resultado;
    }
}
?>

