<?php
require_once "../modelos/Usuario.php";

$usuario = new Usuario();

$idusuario = isset($_POST["idusuario"]) ? limpiarCadena($_POST["idusuario"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
$cedula = isset($_POST["cedula"]) ? limpiarCadena($_POST["cedula"]) : "";
$direccion = isset($_POST["direccion"]) ? limpiarCadena($_POST["direccion"]) : "";
$celular = isset($_POST["celular"]) ? limpiarCadena($_POST["celular"]) : "";
$email = isset($_POST["email"]) ? limpiarCadena($_POST["email"]) : "";
$cargo = isset($_POST["cargo"]) ? limpiarCadena($_POST["cargo"]) : "";
$login = isset($_POST["login"]) ? limpiarCadena($_POST["login"]) : "";
$clave = isset($_POST["clave"]) ? limpiarCadena($_POST["clave"]) : "";
$imagen = isset($_POST["imagen"]) ? limpiarCadena($_POST["imagen"]) : "";

switch ($_GET["op"]) {
    case 'guardaryeditar':
        if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name'])) {
            $imagen = $_POST["imagenactual"];
        } else {
            $ext = explode(".", $_FILES["imagen"]["name"]);
            $imagen = round(microtime(true)) . '.' . end($ext);
            move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/usuarios/" . $imagen);
        }

        if (empty($idusuario)) {
            $rspta = $usuario->insertar($nombre, $cedula, $direccion, $celular, $email, $cargo, $login, $clave, $imagen);
            echo $rspta ? "Usuario registrado" : "No se pudo registrar";
        } else {
            $rspta = $usuario->editar($idusuario, $nombre, $cedula, $direccion, $celular, $email, $cargo, $login, $clave, $imagen);
            echo $rspta ? "Usuario actualizado" : "No se pudo actualizar";
        }
        break;

    case 'desactivar':
        $rspta = $usuario->desactivar($idusuario);
        echo $rspta ? "Usuario desactivado" : "No se pudo desactivar";
        break;

    case 'activar':
        $rspta = $usuario->activar($idusuario);
        echo $rspta ? "Usuario activado" : "No se pudo activar";
        break;

    case 'mostrar':
        $rspta = $usuario->mostrar($idusuario);
        echo json_encode($rspta);
        break;

    case 'listar':
        $rspta = $usuario->listar();
        $data = array();

        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => ($reg->condicion) ?
                    '<button class="btn btn-warning" onclick="mostrar(' . $reg->idusuario . ')"><i class="fa fa-pencil"></i></button>' .
                    ' <button class="btn btn-danger" onclick="desactivar(' . $reg->idusuario . ')"><i class="fa fa-close"></i></button>' :
                    '<button class="btn btn-warning" onclick="mostrar(' . $reg->idusuario . ')"><i class="fa fa-pencil"></i></button>' .
                    ' <button class="btn btn-primary" onclick="activar(' . $reg->idusuario . ')"><i class="fa fa-check"></i></button>',
                "1" => $reg->nombre,
                "2" => $reg->cedula,
                "3" => $reg->celular,
                "4" => $reg->direccion,
                "5" => $reg->email,
                "6" => $reg->cargo,
                "7" => $reg->login,
                "8" => "<img src='../files/usuarios/" . $reg->imagen . "' height='50px' width='50px'>",
                "9" => ($reg->condicion) ? '<span class="label bg-green">Activo</span>' : '<span class="label bg-red">Inactivo</span>'
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



