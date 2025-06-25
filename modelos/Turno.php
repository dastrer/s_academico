<?php
require "../config/Conexion.php";

class Turno {
    public function __construct() {}

    public function insertar($nombre) {
        $sql = "INSERT INTO turno (nombre, condicion) VALUES ('$nombre', '1')";
        return ejecutarConsulta($sql);
    }

    public function editar($idturno, $nombre) {
        $sql = "UPDATE turno SET nombre='$nombre' WHERE idturno='$idturno'";
        return ejecutarConsulta($sql);
    }

    public function desactivar($idturno) {
        $sql = "UPDATE turno SET condicion='0' WHERE idturno='$idturno'";
        return ejecutarConsulta($sql);
    }

    public function activar($idturno) {
        $sql = "UPDATE turno SET condicion='1' WHERE idturno='$idturno'";
        return ejecutarConsulta($sql);
    }

    public function mostrar($idturno) {
        $sql = "SELECT * FROM turno WHERE idturno='$idturno'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar() {
        $sql = "SELECT * FROM turno";
        return ejecutarConsulta($sql);
    }
}
?>
