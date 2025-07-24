<?php
require "../config/Conexion.php";

class Log_materia {
    
    public function __construct() {}

    // Método para listar todos los logs
    public function listar() {
        $sql = "SELECT id_log, accion, fecha FROM log_materia ORDER BY fecha DESC";
        return ejecutarConsulta($sql);
    }

    // Método opcional: insertar un nuevo log manualmente
    public function insertar($accion) {
        $sql = "INSERT INTO log_materia (accion, fecha) VALUES ('$accion', NOW())";
        return ejecutarConsulta($sql);
    }
}
?>
