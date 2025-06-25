<?php
require_once "../modelos/Carrera.php";
require_once "../config/global.php"; // Asegúrate de incluir global.php si limpiarCadena necesita DB_ENCODE
require_once "../config/Conexion.php"; // Incluido para que $conexion esté disponible para limpiarCadena

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

$carrera = new Carrera();

// Datos POST
$idcarrera = isset($_POST["idcarrera"]) ? limpiarCadena($_POST["idcarrera"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";

switch ($_GET["op"]) {
    case 'guardaryeditar':
        if (empty($idcarrera)) {
            $rspta = $carrera->insertar($nombre);
            echo $rspta ? "Carrera registrada" : "Carrera no se pudo registrar";
        } else {
            $rspta = $carrera->editar($idcarrera, $nombre);
            echo $rspta ? "Carrera actualizada" : "Carrera no se pudo actualizar";
        }
        break;

    case 'desactivar':
        $rspta = $carrera->desactivar($idcarrera);
        echo $rspta ? "Carrera desactivada" : "Carrera no se pudo desactivar";
        break;

    case 'activar':
        $rspta = $carrera->activar($idcarrera);
        echo $rspta ? "Carrera activada" : "Carrera no se pudo activar";
        break;

    case 'mostrar':
        $rspta = $carrera->mostrar($idcarrera);
        echo json_encode($rspta);
        break;

    case 'listar':
        $rspta = $carrera->listar();
        $data = [];

        while ($reg = $rspta->fetch_object()) {
            $data[] = [
                "0" => ($reg->condicion) ?
                    '<button class="btn btn-warning" onclick="mostrar(' . $reg->idcarrera . ')"><i class="fa fa-pencil"></i></button>' .
                    ' <button class="btn btn-danger" onclick="desactivar(' . $reg->idcarrera . ')"><i class="fa fa-close"></i></button>' :
                    '<button class="btn btn-warning" onclick="mostrar(' . $reg->idcarrera . ')"><i class="fa fa-pencil"></i></button>' .
                    ' <button class="btn btn-primary" onclick="activar(' . $reg->idcarrera . ')"><i class="fa fa-check"></i></button>',
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
