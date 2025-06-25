<?php
require_once "../modelos/Permiso.php";

$permiso = new Permiso();

$idpermiso = isset($_POST["idpermiso"]) ? limpiarCadena($_POST["idpermiso"]) : "";
$nombre_permiso = isset($_POST["nombre_permiso"]) ? limpiarCadena($_POST["nombre_permiso"]) : "";

switch ($_GET["op"]) {

    case 'guardaryeditar':
        if (empty($idpermiso)) {
            $rspta = $permiso->insertar($nombre_permiso);
            echo $rspta ? "Permiso registrado" : "Permiso no se pudo registrar";
        } else {
            $rspta = $permiso->editar($idpermiso, $nombre_permiso);
            echo $rspta ? "Permiso actualizado" : "Permiso no se pudo actualizar";
        }
        break;

    case 'mostrar':
        $rspta = $permiso->mostrar($idpermiso);
        echo json_encode($rspta);
        break;

    case 'listar':
        $rspta = $permiso->listar();
        $data = array();

        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => '<button class="btn btn-warning" onclick="mostrar(' . $reg->idpermiso . ')"><i class="fa fa-pencil"></i></button>',
                "1" => $reg->nombre_permiso
            );
        }

        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );

        echo json_encode($results);
        break;
}
?>
