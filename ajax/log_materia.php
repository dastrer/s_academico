<?php
require_once "../modelos/Log_materia.php";
require_once "../config/Conexion.php";

// Función de limpieza básica (opcional, ya que aquí no recibimos datos por POST, solo lectura)
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

$log = new Log_materia();

switch ($_GET["op"]) {
    case 'listar':
        $rspta = $log->listar();
        $data = [];

        while ($reg = $rspta->fetch_object()) {
            $data[] = [
                "0" => $reg->id_log,
                "1" => $reg->accion,
                "2" => $reg->fecha
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
