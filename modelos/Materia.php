<?php
require "../config/Conexion.php";

class Materia {
    public function __construct() {}

    public function insertar($nombre) {
        $sql = "INSERT INTO materia (nombre, condicion) VALUES ('$nombre', '1')";
        return ejecutarConsulta($sql);
    }

    public function editar($idmateria, $nombre) {
        $sql = "UPDATE materia SET nombre='$nombre' WHERE idmateria='$idmateria'";
        return ejecutarConsulta($sql);
    }

    public function desactivar($idmateria) {
        $sql = "UPDATE materia SET condicion='0' WHERE idmateria='$idmateria'";
        return ejecutarConsulta($sql);
    }

    public function activar($idmateria) {
        $sql = "UPDATE materia SET condicion='1' WHERE idmateria='$idmateria'";
        return ejecutarConsulta($sql);
    }

    public function mostrar($idmateria) {
        $sql = "SELECT * FROM materia WHERE idmateria='$idmateria'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar() {
        $sql = "SELECT * FROM materia";
        return ejecutarConsulta($sql);
    }
}
?>