<?php
require_once "../modelos/Turno.php";
require_once "../config/global.php";
require_once "../config/Conexion.php";

// Función para limpiar cadenas
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

$turno = new Turno();

// Variables POST
$idturno = isset($_POST["idturno"]) ? limpiarCadena($_POST["idturno"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";

switch ($_GET["op"]) {
    case 'guardaryeditar':
        if (empty($idturno)) {
            $rspta = $turno->insertar($nombre);
            echo $rspta ? "Turno registrado" : "Turno no se pudo registrar";
        } else {
            $rspta = $turno->editar($idturno, $nombre);
            echo $rspta ? "Turno actualizado" : "Turno no se pudo actualizar";
        }
        break;

    case 'desactivar':
        $rspta = $turno->desactivar($idturno);
        echo $rspta ? "Turno desactivado" : "Turno no se pudo desactivar";
        break;

    case 'activar':
        $rspta = $turno->activar($idturno);
        echo $rspta ? "Turno activado" : "Turno no se pudo activar";
        break;

    case 'mostrar':
        $rspta = $turno->mostrar($idturno);
        echo json_encode($rspta);
        break;

    case 'listar':
        $rspta = $turno->listar();
        $data = [];

        while ($reg = $rspta->fetch_object()) {
            $data[] = [
                "0" => ($reg->condicion) ?
                    '<button class="btn btn-warning" onclick="mostrar(' . $reg->idturno . ')"><i class="fa fa-pencil"></i></button>' .
                    ' <button class="btn btn-danger" onclick="desactivar(' . $reg->idturno . ')"><i class="fa fa-close"></i></button>' :
                    '<button class="btn btn-warning" onclick="mostrar(' . $reg->idturno . ')"><i class="fa fa-pencil"></i></button>' .
                    ' <button class="btn btn-primary" onclick="activar(' . $reg->idturno . ')"><i class="fa fa-check"></i></button>',
                "1" => $reg->nombre,
                "2" => $reg->condicion ? '<span class="label bg-green">Activado</span>' : '<span class="label bg-red">Desactivado</span>'
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
