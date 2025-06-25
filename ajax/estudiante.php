<?php
require_once "../modelos/Estudiante.php";
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

$estudiante = new Estudiante();

$idestudiante = isset($_POST["idestudiante"]) ? limpiarCadena($_POST["idestudiante"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
$apellido = isset($_POST["apellido"]) ? limpiarCadena($_POST["apellido"]) : "";
$edad = isset($_POST["edad"]) ? limpiarCadena($_POST["edad"]) : "";
$cedula = isset($_POST["cedula"]) ? limpiarCadena($_POST["cedula"]) : "";
$direccion = isset($_POST["direccion"]) ? limpiarCadena($_POST["direccion"]) : "";
$celular = isset($_POST["celular"]) ? limpiarCadena($_POST["celular"]) : "";
$correo = isset($_POST["correo"]) ? limpiarCadena($_POST["correo"]) : "";
$fecha_nac = isset($_POST["fecha_nac"]) ? limpiarCadena($_POST["fecha_nac"]) : "";

switch ($_GET["op"]) {
    case 'guardaryeditar':
        if (empty($idestudiante)) {
            $rspta = $estudiante->insertar($nombre, $apellido, $edad, $cedula, $direccion, $celular, $correo, $fecha_nac);
            echo $rspta ? "Estudiante registrado" : "Estudiante no se pudo registrar";
        } else {
            $rspta = $estudiante->editar($idestudiante, $nombre, $apellido, $edad, $cedula, $direccion, $celular, $correo, $fecha_nac);
            echo $rspta ? "Estudiante actualizado" : "Estudiante no se pudo actualizar";
        }
        break;

    case 'desactivar':
        $rspta = $estudiante->desactivar($idestudiante);
        echo $rspta ? "Estudiante desactivado" : "Estudiante no se pudo desactivar";
        break;

    case 'activar':
        $rspta = $estudiante->activar($idestudiante);
        echo $rspta ? "Estudiante activado" : "Estudiante no se pudo activar";
        break;

    case 'mostrar':
        $rspta = $estudiante->mostrar($idestudiante);
        echo json_encode($rspta);
        break;

    case 'listar':
        $rspta = $estudiante->listar();
        $data = [];

        while ($reg = $rspta->fetch_object()) {
            $data[] = [
                "0" => ($reg->condicion) ?
                    '<button class="btn btn-warning" onclick="mostrar(' . $reg->idestudiante . ')"><i class="fa fa-pencil"></i></button>' .
                    ' <button class="btn btn-danger" onclick="desactivar(' . $reg->idestudiante . ')"><i class="fa fa-close"></i></button>' :
                    '<button class="btn btn-warning" onclick="mostrar(' . $reg->idestudiante . ')"><i class="fa fa-pencil"></i></button>' .
                    ' <button class="btn btn-primary" onclick="activar(' . $reg->idestudiante . ')"><i class="fa fa-check"></i></button>',
                "1" => $reg->nombre,
                "2" => $reg->apellido,
                "3" => $reg->edad,
                "4" => $reg->cedula,
                "5" => $reg->direccion,
                "6" => $reg->celular,
                "7" => $reg->correo,
                "8" => $reg->fecha_nac,
                "9" => $reg->condicion ? '<span class="label bg-green">Activado</span>' : '<span class="label bg-red">Desactivado</span>'
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