<?php
require "../config/Conexion.php";

class Carrera {
    public function __construct() {}

    public function insertar($nombre) {
        $sql = "INSERT INTO carrera (nombre, condicion) VALUES ('$nombre', '1')";
        return ejecutarConsulta($sql);
    }

    public function editar($idcarrera, $nombre) {
        $sql = "UPDATE carrera SET nombre='$nombre' WHERE idcarrera='$idcarrera'";
        return ejecutarConsulta($sql);
    }

    public function desactivar($idcarrera) {
        $sql = "UPDATE carrera SET condicion='0' WHERE idcarrera='$idcarrera'";
        return ejecutarConsulta($sql);
    }

    public function activar($idcarrera) {
        $sql = "UPDATE carrera SET condicion='1' WHERE idcarrera='$idcarrera'";
        return ejecutarConsulta($sql);
    }

    public function mostrar($idcarrera) {
        $sql = "SELECT * FROM carrera WHERE idcarrera='$idcarrera'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar() {
        $sql = "SELECT * FROM carrera";
        return ejecutarConsulta($sql);
    }
}
?>
