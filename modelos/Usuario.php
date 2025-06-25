<?php
require "../config/Conexion.php";

function limpiarCadena($str){
    $str = trim($str);
    $str = stripslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}

class Usuario
{
    public function __construct()
    {
    }

    public function insertar($nombre, $cedula, $direccion, $celular, $email, $cargo, $login, $clave, $imagen)
    {
        $clavehash = hash("SHA256", $clave);
        $sql = "INSERT INTO usuario (nombre, cedula, direccion, celular, email, cargo, login, clave, imagen, condicion)
                VALUES ('$nombre', '$cedula', '$direccion', '$celular', '$email', '$cargo', '$login', '$clavehash', '$imagen', '1')";
        return ejecutarConsulta($sql);
    }

    public function editar($idusuario, $nombre, $cedula, $direccion, $celular, $email, $cargo, $login, $clave, $imagen)
    {
        if (empty($clave)) {
            // No actualiza clave si está vacía
            $sql = "UPDATE usuario SET nombre='$nombre', cedula='$cedula', direccion='$direccion', celular='$celular',
                    email='$email', cargo='$cargo', login='$login', imagen='$imagen'
                    WHERE idusuario='$idusuario'";
        } else {
            $clavehash = hash("SHA256", $clave);
            $sql = "UPDATE usuario SET nombre='$nombre', cedula='$cedula', direccion='$direccion', celular='$celular',
                    email='$email', cargo='$cargo', login='$login', clave='$clavehash', imagen='$imagen'
                    WHERE idusuario='$idusuario'";
        }
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

