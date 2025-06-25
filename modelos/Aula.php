<?php
require "../config/Conexion.php";

class Aula {
    public function __construct() {}

    public function insertar($nombre) {
        $sql = "INSERT INTO aula (nombre, condicion) VALUES ('$nombre', '1')";
        return ejecutarConsulta($sql);
    }

    public function editar($idaula, $nombre) {
        $sql = "UPDATE aula SET nombre='$nombre' WHERE idaula='$idaula'";
        return ejecutarConsulta($sql);
    }

    public function desactivar($idaula) {
        $sql = "UPDATE aula SET condicion='0' WHERE idaula='$idaula'";
        return ejecutarConsulta($sql);
    }

    public function activar($idaula) {
        $sql = "UPDATE aula SET condicion='1' WHERE idaula='$idaula'";
        return ejecutarConsulta($sql);
    }

    public function mostrar($idaula) {
        $sql = "SELECT * FROM aula WHERE idaula='$idaula'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar() {
        $sql = "SELECT * FROM aula";
        return ejecutarConsulta($sql);
    }
}
?>
