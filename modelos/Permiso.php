<?php
require "../config/Conexion.php";

class Permiso
{
    public function __construct()
    {
    }

    public function insertar($nombre_permiso)
    {
        $sql = "INSERT INTO permiso (nombre_permiso) VALUES ('$nombre_permiso')";
        return ejecutarConsulta($sql);
    }

    public function editar($idpermiso, $nombre_permiso)
    {
        $sql = "UPDATE permiso SET nombre_permiso='$nombre_permiso' WHERE idpermiso='$idpermiso'";
        return ejecutarConsulta($sql);
    }

    public function mostrar($idpermiso)
    {
        $sql = "SELECT * FROM permiso WHERE idpermiso='$idpermiso'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar()
    {
        $sql = "SELECT * FROM permiso";
        return ejecutarConsulta($sql);
    }
}
?>
