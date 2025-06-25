<?php
require_once "../modelos/Grado.php";
require_once "../config/global.php";
require_once "../config/Conexion.php";

// Función para limpiar cadenas y prevenir inyección SQL y XSS
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

$grado = new Grado();

// Se usa limpiarCadena para los datos recibidos por POST
$idgrado = isset($_POST["idgrado"]) ? limpiarCadena($_POST["idgrado"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";

switch ($_GET["op"]) {
    case 'guardaryeditar':
        if (empty($idgrado)) {
            $rspta = $grado->insertar($nombre);
            echo $rspta ? "Grado registrado" : "Grado no se pudo registrar";
        } else {
            $rspta = $grado->editar($idgrado, $nombre);
            echo $rspta ? "Grado actualizado" : "Grado no se pudo actualizar";
        }
        break;

    case 'desactivar':
        $rspta = $grado->desactivar($idgrado);
        echo $rspta ? "Grado desactivado" : "Grado no se pudo desactivar";
        break;

    case 'activar':
        $rspta = $grado->activar($idgrado);
        echo $rspta ? "Grado activado" : "Grado no se pudo activar";
        break;

    case 'mostrar':
        $rspta = $grado->mostrar($idgrado);
        echo json_encode($rspta);
        break;

    case 'listar':
        $rspta = $grado->listar();
        $data = [];

        while ($reg = $rspta->fetch_object()) {
            $data[] = [
                "0" => ($reg->condicion) ?
                    '<button class="btn btn-warning" onclick="mostrar(' . $reg->idgrado . ')"><i class="fa fa-pencil"></i></button>' .
                    ' <button class="btn btn-danger" onclick="desactivar(' . $reg->idgrado . ')"><i class="fa fa-close"></i></button>' :
                    '<button class="btn btn-warning" onclick="mostrar(' . $reg->idgrado . ')"><i class="fa fa-pencil"></i></button>' .
                    ' <button class="btn btn-primary" onclick="activar(' . $reg->idgrado . ')"><i class="fa fa-check"></i></button>',
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
