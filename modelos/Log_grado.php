<?php
require "../config/Conexion.php";

class Log_grado {
    
    public function __construct() {}

    // Método para listar todos los logs de grado
    public function listar() {
        $sql = "SELECT id_log, accion, fecha FROM log_grado ORDER BY fecha DESC";
        return ejecutarConsulta($sql);
    }

    // Método opcional para insertar un nuevo log manualmente
    public function insertar($accion) {
        $sql = "INSERT INTO log_grado (accion, fecha) VALUES ('$accion', NOW())";
        return ejecutarConsulta($sql);
    }
}
?>
