<?php
require "../config/Conexion.php";

class Estudiante {
    public function __construct() {}

    public function insertar($nombre, $apellido, $edad, $cedula, $direccion, $celular, $correo, $fecha_nac) {
        $sql = "INSERT INTO estudiante (nombre, apellido, edad, cedula, direccion, celular, correo, fecha_nac, condicion)
                VALUES ('$nombre', '$apellido', '$edad', '$cedula', '$direccion', '$celular', '$correo', '$fecha_nac', '1')";
        return ejecutarConsulta($sql);
    }

    public function editar($idestudiante, $nombre, $apellido, $edad, $cedula, $direccion, $celular, $correo, $fecha_nac) {
        $sql = "UPDATE estudiante SET nombre='$nombre', apellido='$apellido', edad='$edad', cedula='$cedula', direccion='$direccion', celular='$celular', correo='$correo', fecha_nac='$fecha_nac'
                WHERE idestudiante='$idestudiante'";
        return ejecutarConsulta($sql);
    }

    public function desactivar($idestudiante) {
        $sql = "UPDATE estudiante SET condicion='0' WHERE idestudiante='$idestudiante'";
        return ejecutarConsulta($sql);
    }

    public function activar($idestudiante) {
        $sql = "UPDATE estudiante SET condicion='1' WHERE idestudiante='$idestudiante'";
        return ejecutarConsulta($sql);
    }

    public function mostrar($idestudiante) {
        $sql = "SELECT * FROM estudiante WHERE idestudiante='$idestudiante'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar() {
        $sql = "SELECT * FROM estudiante";
        return ejecutarConsulta($sql);
    }
}
?>