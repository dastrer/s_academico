<?php
require "../config/Conexion.php";

class Docente {
    public function __construct() {}

    public function insertar($nombre, $apellido, $cedula, $direccion, $celular, $correo, $nivel_est) {
        $sql = "INSERT INTO docente (nombre, apellido, cedula, direccion, celular, correo, nivel_est, condicion)
                VALUES ('$nombre', '$apellido', '$cedula', '$direccion', '$celular', '$correo', '$nivel_est', '1')";
        return ejecutarConsulta($sql);
    }

    public function editar($iddocente, $nombre, $apellido, $cedula, $direccion, $celular, $correo, $fecha_nac) {
        $sql = "UPDATE docente SET nombre='$nombre', apellido='$apellido', cedula='$cedula', direccion='$direccion', celular='$celular', correo='$correo', nivel_est='$nivel_est'
                WHERE iddocente='$iddocente'";
        return ejecutarConsulta($sql);
    }

    public function desactivar($iddocente) {
        $sql = "UPDATE docente SET condicion='0' WHERE iddocente='$iddocente'";
        return ejecutarConsulta($sql);
    }

    public function activar($iddocente) {
        $sql = "UPDATE docente SET condicion='1' WHERE iddocente='$iddocente'";
        return ejecutarConsulta($sql);
    }

    public function mostrar($iddocente) {
        $sql = "SELECT * FROM docente WHERE iddocente='$iddocente'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar() {
        $sql = "SELECT * FROM docente";
        return ejecutarConsulta($sql);
    }
}
?>