<?php
require_once "../modelos/Aula.php";
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

$aula = new Aula();

// Variables POST
$idaula = isset($_POST["idaula"]) ? limpiarCadena($_POST["idaula"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";

switch ($_GET["op"]) {
    case 'guardaryeditar':
        if (empty($idaula)) {
            $rspta = $aula->insertar($nombre);
            echo $rspta ? "Aula registrada" : "Aula no se pudo registrar";
        } else {
            $rspta = $aula->editar($idaula, $nombre);
            echo $rspta ? "Aula actualizada" : "Aula no se pudo actualizar";
        }
        break;

    case 'desactivar':
        $rspta = $aula->desactivar($idaula);
        echo $rspta ? "Aula desactivada" : "Aula no se pudo desactivar";
        break;

    case 'activar':
        $rspta = $aula->activar($idaula);
        echo $rspta ? "Aula activada" : "Aula no se pudo activar";
        break;

    case 'mostrar':
        $rspta = $aula->mostrar($idaula);
        echo json_encode($rspta);
        break;

    case 'listar':
        $rspta = $aula->listar();
        $data = [];

        while ($reg = $rspta->fetch_object()) {
            $data[] = [
                "0" => ($reg->condicion) ?
                    '<button class="btn btn-warning" onclick="mostrar(' . $reg->idaula . ')"><i class="fa fa-pencil"></i></button>' .
                    ' <button class="btn btn-danger" onclick="desactivar(' . $reg->idaula . ')"><i class="fa fa-close"></i></button>' :
                    '<button class="btn btn-warning" onclick="mostrar(' . $reg->idaula . ')"><i class="fa fa-pencil"></i></button>' .
                    ' <button class="btn btn-primary" onclick="activar(' . $reg->idaula . ')"><i class="fa fa-check"></i></button>',
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
