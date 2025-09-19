<?php
require_once "../model/clienteModel.php";

$cliente = new ClienteModel();

$tipo = $_REQUEST['tipo'] ?? '';

switch ($tipo) {
    case "listar":
        echo json_encode($cliente->getClientes());
        break;

    case "obtener":
        $id = $_GET['id'];
        echo json_encode($cliente->getCliente($id));
        break;

    case "guardar":
        $id = $_POST['id'] ?? "";
        $dni = $_POST['dni'];
        $nombre = $_POST['nombre_apellidos'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $estado = $_POST['estado'] ?? "activo";

        if ($id == "") {
            $res = $cliente->insertarCliente($dni, $nombre, $telefono, $correo);
        } else {
            $res = $cliente->actualizarCliente($id, $dni, $nombre, $telefono, $correo, $estado);
        }
        echo json_encode(["status" => $res]);
        break;

    case "eliminar":
        $id = $_POST['id'];
        $res = $cliente->eliminarCliente($id);
        echo json_encode(["status" => $res]);
        break;

    default:
        echo json_encode(["error" => "Acción no válida"]);
}
