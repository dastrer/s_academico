<?php
require "../config/Conexion.php";

class Usuario
{
    public function __construct()
    {
    }

    public function insertar($nombre, $celular, $direccion, $email, $cargo, $clave, $imagen)
    {
        $clavehash = hash("SHA256", $clave);
        $sql = "INSERT INTO usuario (nombre, celular, direccion, email, cargo, clave, imagen, condicion)
                VALUES ('$nombre', '$celular', '$direccion', '$email', '$cargo', '$clavehash', '$imagen', '1')";
        return ejecutarConsulta($sql);
    }

    public function editar($idusuario, $nombre, $celular, $direccion, $email, $cargo, $clave, $imagen)
    {
        $clavehash = hash("SHA256", $clave);
        $sql = "UPDATE usuario SET nombre='$nombre', celular='$celular', direccion='$direccion',
                email='$email', cargo='$cargo', clave='$clavehash', imagen='$imagen'
                WHERE idusuario='$idusuario'";
        return ejecutarConsulta($sql);
    }

    public function desactivar($idusuario)
    {
        $sql = "UPDATE usuario SET condicion='0' WHERE idusuario='$idusuario'";
        return ejecutarConsulta($sql);
    }

    public function activar($idusuario)
    {
        $sql = "UPDATE usuario SET condicion='1' WHERE idusuario='$idusuario'";
        return ejecutarConsulta($sql);
    }

    public function mostrar($idusuario)
    {
        $sql = "SELECT * FROM usuario WHERE idusuario='$idusuario'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar()
    {
        $sql = "SELECT * FROM usuario";
        return ejecutarConsulta($sql);
    }
}
?>
