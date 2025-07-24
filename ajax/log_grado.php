<?php
require_once "../modelos/Log_grado.php";
require_once "../config/Conexion.php";

// Función de limpieza básica (opcional en este contexto)
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

$log = new Log_grado(); // ← CORREGIDO nombre de clase

switch ($_GET["op"]) {
    case 'listar':
        $rspta = $log->listar(); // Llama al método listar() del modelo
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
