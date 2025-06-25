<?php
require_once "../modelos/Materia.php";
require_once "../config/global.php"; // Asegúrate de incluir global.php si limpiarCadena necesita DB_ENCODE, aunque no es estrictamente necesario para la función simple.
require_once "../config/Conexion.php"; // Asegúrate de que Conexion.php esté incluido para que $conexion esté disponible para limpiarCadena

// Función para limpiar cadenas y prevenir inyección SQL y XSS
// Idealmente esta función debería estar en un archivo de utilidades o en Conexion.php
// Aquí la definimos si no está en otro lugar.
if (!function_exists('limpiarCadena')) {
    function limpiarCadena($cadena) {
        global $conexion; // Aseguramos acceso a la conexión para real_escape_string
        $cadena = trim($cadena); // Elimina espacios en blanco del inicio y/o final
        $cadena = stripslashes($cadena); // Elimina las barras de un string con comillas escapadas
        $cadena = htmlspecialchars($cadena); // Convierte caracteres especiales en entidades HTML
        // Escapa caracteres especiales en una cadena para usarla en una sentencia SQL
        // Es crucial para prevenir inyección SQL
        if (isset($conexion) && $conexion instanceof mysqli) { // Asegúrate de que $conexion es un objeto mysqli
            $cadena = $conexion->real_escape_string($cadena);
        }
        return $cadena;
    }
}


$materia = new Materia();

// Se usa limpiarCadena para los datos recibidos por POST
$idmateria = isset($_POST["idmateria"]) ? limpiarCadena($_POST["idmateria"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";

switch ($_GET["op"]) {
    case 'guardaryeditar':
        if (empty($idmateria)) {
            $rspta = $materia->insertar($nombre);
            echo $rspta ? "Materia registrada" : "Materia no se pudo registrar";
        } else {
            $rspta = $materia->editar($idmateria, $nombre);
            echo $rspta ? "Materia actualizada" : "Materia no se pudo actualizar";
        }
        break;

    case 'desactivar':
        $rspta = $materia->desactivar($idmateria);
        echo $rspta ? "Materia desactivada" : "Materia no se pudo desactivar";
        break;

    case 'activar':
        $rspta = $materia->activar($idmateria);
        echo $rspta ? "Materia activada" : "Materia no se pudo activar";
        break;

    case 'mostrar':
        $rspta = $materia->mostrar($idmateria);
        echo json_encode($rspta);
        break;

    case 'listar':
        $rspta = $materia->listar();
        $data = [];

        while ($reg = $rspta->fetch_object()) {
            $data[] = [
                "0" => ($reg->condicion) ?
                    '<button class="btn btn-warning" onclick="mostrar(' . $reg->idmateria . ')"><i class="fa fa-pencil"></i></button>' .
                    ' <button class="btn btn-danger" onclick="desactivar(' . $reg->idmateria . ')"><i class="fa fa-close"></i></button>' :
                    '<button class="btn btn-warning" onclick="mostrar(' . $reg->idmateria . ')"><i class="fa fa-pencil"></i></button>' .
                    ' <button class="btn btn-primary" onclick="activar(' . $reg->idmateria . ')"><i class="fa fa-check"></i></button>',
                "1" => $reg->nombre,
                "2" => $reg->condicion ? '<span class="label bg-green">Activado</span>' : '<span class="label bg-red">Desactivado</span>'
            ];
        }

        $results = [
            "sEcho" => 1, //Información para el datatables
            "iTotalRecords" => count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords" => count($data), //enviamos el total registros a visualizar
            "aaData" => $data
        ];
        echo json_encode($results);
        break;
}
?>