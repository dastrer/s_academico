<?php
require_once "../modelos/Docente.php";
require_once "../config/global.php";
require_once "../config/Conexion.php";

if (!function_exists('limpiarCadena')) {
    function limpiarCadena($cadena) {
        global $conexion;
        $cadena = trim($cadena);
        $cadena = stripslashes($cadena);
        $cadena = htmlspecialchars($cadena);
        if (isset($conexion) && $conexion instanceof mysqli) {
            $cadena = $conexion->real_escape_string($cadena);
        }
        return $cadena;
    }
}

$docente = new Docente();

$iddocente = isset($_POST["iddocente"]) ? limpiarCadena($_POST["iddocente"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
$apellido = isset($_POST["apellido"]) ? limpiarCadena($_POST["apellido"]) : "";
$cedula = isset($_POST["cedula"]) ? limpiarCadena($_POST["cedula"]) : "";
$direccion = isset($_POST["direccion"]) ? limpiarCadena($_POST["direccion"]) : "";
$celular = isset($_POST["celular"]) ? limpiarCadena($_POST["celular"]) : "";
$correo = isset($_POST["correo"]) ? limpiarCadena($_POST["correo"]) : "";
$nivel_est = isset($_POST["nivel_est"]) ? limpiarCadena($_POST["nivel_est"]) : "";

switch ($_GET["op"]) {
    case 'guardaryeditar':
        if (empty($iddocente)) {
            $rspta = $docente->insertar($nombre, $apellido, $cedula, $direccion, $celular, $correo, $nivel_est);
            echo $rspta ? "Docente registrado" : "Docente no se pudo registrar";
        } else {
            $rspta = $docente->editar($iddocente, $nombre, $apellido, $cedula, $direccion, $celular, $correo, $nivel_est);
            echo $rspta ? "Docente actualizado" : "Docente no se pudo actualizar";
        }
        break;

    case 'desactivar':
        $rspta = $docente->desactivar($iddocente);
        echo $rspta ? "Docente desactivado" : "Docente no se pudo desactivar";
        break;

    case 'activar':
        $rspta = $docente->activar($iddocente);
        echo $rspta ? "Docente activado" : "Docente no se pudo activar";
        break;

    case 'mostrar':
        $rspta = $docente->mostrar($iddocente);
        echo json_encode($rspta);
        break;

    case 'listar':
        $rspta = $docente->listar();
        $data = [];

        while ($reg = $rspta->fetch_object()) {
            $data[] = [
                "0" => ($reg->condicion) ?
                    '<button class="btn btn-warning" onclick="mostrar(' . $reg->iddocente . ')"><i class="fa fa-pencil"></i></button>' .
                    ' <button class="btn btn-danger" onclick="desactivar(' . $reg->iddocente . ')"><i class="fa fa-close"></i></button>' :
                    '<button class="btn btn-warning" onclick="mostrar(' . $reg->iddocente . ')"><i class="fa fa-pencil"></i></button>' .
                    ' <button class="btn btn-primary" onclick="activar(' . $reg->iddocente . ')"><i class="fa fa-check"></i></button>',
                "1" => $reg->nombre,
                "2" => $reg->apellido,
                "3" => $reg->cedula,
                "4" => $reg->direccion,
                "5" => $reg->celular,
                "6" => $reg->correo,
                "7" => $reg->nivel_est,
                "8" => $reg->condicion ? '<span class="label bg-green">Activado</span>' : '<span class="label bg-red">Desactivado</span>'
            ];
        }

        $results = [
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        ];
        echo json_encode($results);
        break;
}
?>