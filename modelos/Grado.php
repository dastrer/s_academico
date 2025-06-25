<?php
require "../config/Conexion.php";

class Grado {
    public function __construct() {}

    public function insertar($nombre) {
        $sql = "INSERT INTO grado (nombre, condicion) VALUES ('$nombre', '1')";
        return ejecutarConsulta($sql);
    }

    public function editar($idgrado, $nombre) {
        $sql = "UPDATE grado SET nombre='$nombre' WHERE idgrado='$idgrado'";
        return ejecutarConsulta($sql);
    }

    public function desactivar($idgrado) {
        $sql = "UPDATE grado SET condicion='0' WHERE idgrado='$idgrado'";
        return ejecutarConsulta($sql);
    }

    public function activar($idgrado) {
        $sql = "UPDATE grado SET condicion='1' WHERE idgrado='$idgrado'";
        return ejecutarConsulta($sql);
    }

    public function mostrar($idgrado) {
        $sql = "SELECT * FROM grado WHERE idgrado='$idgrado'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar() {
        $sql = "SELECT * FROM grado";
        return ejecutarConsulta($sql);
    }
}
?>
